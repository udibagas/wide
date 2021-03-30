<?php

namespace App\Console\Commands;

use App\Models\Router;
use App\Models\User;
use App\Notifications\VoucherGeneratedNotification;
use Illuminate\Console\Command;
use RouterOS\Client;
use RouterOS\Query;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;

class GenerateVoucher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voucher:generate
        {router : IP Address Router}
        {--S|server=all : Hotspot server}
        {--P|profile=default : Nama profile}
        {--Q|qty=1 : Jumlah voucher}
        {--T|time_limit=1h : Batas waktu}
        {--C|comment= : Keterangan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate voucher based on profile';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $router = Router::where('host', $this->argument('router'))->first();

        if (!$router) {
            $this->error('Router tidak terdaftar');
            $this->line('Berikut router yang terdaftar:');
            $this->table(
                ['Name', 'IP Address'],
                Router::all(['name', 'host'])->toArray()
            );
            return;
        }

        $client = new Client([
            'host' => $router->host,
            'user' => $router->user,
            'pass' => $router->pass,
            'timeout' => 30
        ]);

        $this->info('Router connected');

        // $server = $client->query((new Query('/ip/hotspot/print')))->read();
        // $profile = $client->query((new Query('/ip/hotspot/user/profile/print')))->read();

        // print_r($server);
        // print_r($profile);
        // return;

        $qty = $this->option('qty');
        $comment = $this->option('comment') ?? "vc-"  . $this->option('profile') . "-{$qty}pcs-" . date('d-M-Y');

        try {
            $qty = $this->option('qty');

            for ($i = 1; $i <= $qty; $i++) {
                $name = strtolower(Str::random(8));
                $this->line("Creating user {$i}/{$qty} {$name} ...");
                $query = (new Query('/ip/hotspot/user/add'))
                    ->equal('name', $name)
                    ->equal('password', $name)
                    // ->equal('server', $this->option('server'))
                    ->equal('profile', $this->option('profile'))
                    ->equal('limit-uptime', $this->option('time_limit'))
                    ->equal('comment', $comment);

                $response = $client->query($query)->read();
                print_r($response);
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        // $pdf = PDF::loadView();


        // $domPdf->loadHtmlFile(url("/voucher/print/{$router->id}?comment=" . urlencode($comment)));

        $this->info("Vucher has been generated with comment = {$comment}");
        $this->line("http://mikhmon.wide.co.id/voucher/print.php?id={$comment}&qr=no&session=Wide2-DesaSiling");
        // http://mikhmon.wide.co.id/voucher/print.php?id=vc-257-03.12.21-&qr=no&session=Wide2-DesaSiling
        // $user = User::first();
        // $user->notify(new VoucherGeneratedNotification($comment, $domPdf->render()));
    }
}
