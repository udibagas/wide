<?php

namespace App\Http\Controllers;

use App\Models\Router;
use App\Models\Voucher;
use App\Notifications\VoucherGeneratedNotification;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use RouterOS\Client;
use RouterOS\Query;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    public function print(Request $request)
    {
        return view('voucher.print', [
            'vouchers' => Voucher::where('comment', $request->comment)->get()
        ]);
    }

    public function print1(Router $router, Request $request)
    {
        $request->validate(['comment' => 'required']);

        $client = new Client([
            'host' => $router->host,
            'user' => $router->user,
            'pass' => $router->pass
        ]);

        $users = $client->query(
            (new Query('/ip/hotspot/user/print'))
                ->where('comment', $request->comment)
                ->where('uptime', '0s')
        )->read();

        // return $users;

        if (count($users) > 0) {
            $server = $client->query(
                (new Query('/ip/hotspot/print'))
                    ->where('name', $users[0]['server'])
            )->read();

            $serverProfile = $client->query(
                (new Query('/ip/hotspot/profile/print'))
                    ->where('name', $server[0]['profile'])
            )->read();

            $profile = $client->query(
                (new Query('/ip/hotspot/user/profile/print'))
                    ->where('name', $users[0]['profile'])
            )->read();

            $onLogin = explode(',', $profile[0]['on-login']);

            // return [
            //     'server' => $server,
            //     'server-profile' => $serverProfile,
            //     'profile' => $profile,
            //     'users' => $users,
            // ];

            return view('voucher.print', [
                'serverName'   => $server[0]['name'],
                'dnsName'      => $serverProfile[0]['dns-name'],
                'validity'      => $onLogin[3],
                'price'         => $onLogin[4],
                'users'         => $users,
            ]);
        }

        return response("No record for {$request->comment}", 404);
    }

    public function generate(Request $request)
    {
        $vouchers = [];

        for ($i = 1; $i <= $request->qty; $i++) {
            $vouchers[] = substr($request->uptime, 0, 2) . rand(100, 999) . static::randomString();
        }

        Voucher::insert(array_map(function ($voucher) use ($request) {
            return [
                'site'      => $request->site,
                'dns'       => $request->dns,
                'uptime'    => $request->uptime,
                'profile'   => $request->uptime,
                'validity'  => $request->validity,
                'price'     => $request->price,
                'seller_price' => $request->seller_price,
                'code'      => $voucher,
                'comment'   => $request->comment,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $vouchers));

        // TODO: harusnya kirim email kalau sukses sudah tercreate
        Notification::route('mail', $request->email ?: 'udibagas@wide.co.id')
            ->notify(new VoucherGeneratedNotification($request->comment));

        return implode(',', $vouchers);
    }

    public static function randomString($length = 3)
    {
        $string = 'abcdefghijkmnprstuvwxyz';
        $ret = '';

        for ($i = 1; $i <= $length; $i++) {
            $ret .= $string[rand(0, strlen($string) - 1)];
        }

        return $ret;
    }
}
