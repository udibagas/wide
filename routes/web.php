<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VoucherController;
use chillerlan\QRCode\QRCode;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('voucher/print', [VoucherController::class, 'print']);

Route::get('test', function (Request $request) {
    return '<img src="' . (new QRCode)->render('test123') . '" />';
    // $client = new Client();
    // $response = $client->get("http://mikhmon.wide.co.id/voucher/print.php?id=vc-497-03.12.21-test-voucher&qr=no&session=Test");
    // return $response->getBody()->getContents();

    // return file_get_contents("http://mikhmon.wide.co.id/voucher/print.php?id=vc-497-03.12.21-test-voucher&qr=no&session=Test");
    // return response()->streamDownload(function () use ($pdf) {
    //     echo $pdf;
    // }, 'file.pdf');
});
