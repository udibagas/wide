<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate script untuk generate user hotspot';

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
        $sites = [
            'WIDE1-Pintas' => [
                'email' => 'udibagas@wide.co.id',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 10000, 'seller_price' => 7000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 15000, 'seller_price' => 12000, 'validity' => '1hari'],
                    // '3jam' => ['uptime' => '3h', 'price' => 20000, 'seller_price' => 15000, 'validity' => '1hari'],
                    '5jam' => ['uptime' => '5h', 'price' => 25000, 'seller_price' => 20000, 'validity' => '2hari'],
                    '1bulan' => ['uptime' => '30d', 'price' => 350000, 'seller_price' => 300000, 'validity' => '30hari'],
                ]
            ],

            'WIDE2-Siling' => [
                'email' => 'udibagas@wide.co.id',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 10000, 'seller_price' => 8000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 15000, 'seller_price' => 12000, 'validity' => '1hari'],
                    // '3jam' => ['uptime' => '3h', 'price' => 20000, 'seller_price' => 15000, 'validity' => '1hari'],
                    '5jam' => ['uptime' => '5h', 'price' => 25000, 'seller_price' => 20000, 'validity' => '2hari'],
                ]
            ],

            'MajuJayaCoffe' => [
                'email' => 'udibagas@wide.co.id',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 10000, 'seller_price' => 8000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 15000, 'seller_price' => 12000, 'validity' => '1hari'],
                    // '3jam' => ['uptime' => '3h', 'price' => 20000, 'seller_price' => 15000, 'validity' => '1hari'],
                    '5jam' => ['uptime' => '5h', 'price' => 25000, 'seller_price' => 20000, 'validity' => '2hari'],
                ]
            ],

            'WIDE4-Sayan2' => [
                'email' => 'udibagas@wide.co.id',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 10000, 'seller_price' => 7000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 15000, 'seller_price' => 11000, 'validity' => '1hari'],
                    '3jam' => ['uptime' => '3h', 'price' => 20000, 'seller_price' => 15000, 'validity' => '1hari'],
                    '5jam' => ['uptime' => '5h', 'price' => 25000, 'seller_price' => 19000, 'validity' => '2hari'],
                    '1bulan' => ['uptime' => '30d', 'price' => 350000, 'seller_price' => 300000, 'validity' => '30hari'],
                ]
            ],

            'WIDE5-KM74' => [
                'email' => 'almaapinoh@gmail.com',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 10000, 'seller_price' => 8000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 15000, 'seller_price' => 12000, 'validity' => '1hari'],
                    '3jam' => ['uptime' => '3h', 'price' => 20000, 'seller_price' => 15000, 'validity' => '1hari'],
                    '5jam' => ['uptime' => '5h', 'price' => 25000, 'seller_price' => 20000, 'validity' => '2hari'],
                ]
            ],

            'WIDE6-YOEL-SBN' => [
                'email' => 'udibagas@wide.co.id',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 8000, 'seller_price' => 6000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 12000, 'seller_price' => 10000, 'validity' => '1hari'],
                    '3jam' => ['uptime' => '3h', 'price' => 17000, 'seller_price' => 14000, 'validity' => '1hari'],
                    '5jam' => ['uptime' => '5h', 'price' => 25000, 'seller_price' => 20000, 'validity' => '2hari'],
                    '200mb' => ['uptime' => '12h', 'price' => 10000, 'seller_price' => 7000, 'validity' => '12jam'],
                    '300mb' => ['uptime' => '1d', 'price' => 13000, 'seller_price' => 10000, 'validity' => '1hari'],
                ]
            ],

            'WIDE7-BinaKarya' => [
                'email' => 'udibagas@wide.co.id',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 10000, 'seller_price' => 7000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 15000, 'seller_price' => 11000, 'validity' => '1hari'],
                    '3jam' => ['uptime' => '3h', 'price' => 20000, 'seller_price' => 16000, 'validity' => '1hari'],
                    '5jam' => ['uptime' => '5h', 'price' => 25000, 'seller_price' => 20000, 'validity' => '2hari'],
                    '1bulan' => ['uptime' => '30d', 'price' => 350000, 'seller_price' => 30000, 'validity' => '30hari'],
                ]
            ],
            'WIDE8-KM69' => [
                'email' => 'udibagas@wide.co.id',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 10000, 'seller_price' => 6000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 15000, 'seller_price' => 10000, 'validity' => '1hari'],
                    '3jam' => ['uptime' => '3h', 'price' => 20000, 'seller_price' => 13000, 'validity' => '1hari'],
                    '5jam' => ['uptime' => '5h', 'price' => 25000, 'seller_price' => 20000, 'validity' => '2hari'],
                    '1bulan' => ['uptime' => '30d', 'price' => 350000, 'seller_price' => 300000, 'validity' => '30hari'],
                ]
            ],
            'WIDE9-BEROBAI' => [
                'email' => 'udibagas@wide.co.id',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 10000, 'seller_price' => 7000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 15000, 'seller_price' => 10000, 'validity' => '1hari'],
                    '3jam' => ['uptime' => '3h', 'price' => 20000, 'seller_price' => 15000, 'validity' => '1hari'],
                    '200mb' => ['uptime' => '12h', 'price' => 10000, 'seller_price' => 7000, 'validity' => '12jam'],
                    '300mb' => ['uptime' => '1d', 'price' => 15000, 'seller_price' => 10000, 'validity' => '1hari'],
                    '400mb' => ['uptime' => '1d', 'price' => 20000, 'seller_price' => 15000, 'validity' => '1hari'],
                ]
            ],
            'WIDE10-KRUE' => [
                'email' => 'udibagas@wide.co.id',
                'profiles' => [
                    '1jam' => ['uptime' => '1h', 'price' => 10000, 'seller_price' => 6000, 'validity' => '1hari'],
                    '2jam' => ['uptime' => '2h', 'price' => 15000, 'seller_price' => 10000, 'validity' => '1hari'],
                    '3jam' => ['uptime' => '3h', 'price' => 20000, 'seller_price' => 15000, 'validity' => '1hari'],
                    '5jam' => ['uptime' => '3h', 'price' => 25000, 'seller_price' => 20000, 'validity' => '1hari'],
                ]
            ],
        ];

        $comment    = 'vc-' . date('d.m.y.h.i.') . time();
        $site       = $this->choice('Site', array_keys($sites));
        $email      = $this->ask('Email', $sites[$site]['email']);
        $dns        = $this->ask('DNS', 'wide.kalbar');
        $profile    = $this->choice('Profile', array_keys($sites[$site]['profiles']));
        $uptime     = $sites[$site]['profiles'][$profile]['uptime'];
        $validity   = $sites[$site]['profiles'][$profile]['validity'];
        $price      = $this->ask('Price', $sites[$site]['profiles'][$profile]['price']);
        $seller_price = $this->ask('Seller Price', $sites[$site]['profiles'][$profile]['seller_price']);
        $total      = $this->ask('Total', 0);
        $qty        = 50;

        if ($total > 0) {
            $qty = ceil($total / $seller_price);
        }

        $qty        = $this->ask('Qty', $qty);

        $this->table(
            ['Parameter', 'Value'],
            [
                ['Comment', $comment],
                ['Site', $site],
                ['Email', $email],
                ['DNS', $dns],
                ['Profile', $profile],
                ['Uptime', $uptime],
                ['Validity', $validity],
                ['Qty', $qty],
                ['Price', number_format($price)],
                ['Seller Price', number_format($seller_price)],
                ['Total', number_format($seller_price * $qty)],
            ]
        );

        $this->line('tool fetch url="http://dashboard.wide.co.id/api/voucher/generate\?qty=' . $qty . '&uptime=' . $profile . '&validity=' . $validity . '&price=' . $price . '&seller_price=' . $seller_price . '&site=' . $site . '&dns=' . $dns . '&comment=' . $comment . '&email=' . $email . '" dst-path=voucher.txt; :foreach code in=[:toarray [file get voucher.txt contents]] do={ ip hotspot user add name=$code password=$code profile=' . $profile . ' limit-uptime=' . $uptime . ' comment=' . $comment . '; }; ip hotspot user print count-only where comment=' . $comment . '; tool fetch url="http://dashboard.wide.co.id/api/voucher/notify\?email=' . $email . '&comment=' . $comment . '"');
    }
}
