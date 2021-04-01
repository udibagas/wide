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
        $profiles = [
            '1jam' => ['uptime' => '1h', 'price' => 10000, 'validity' => '1hari'],
            '2jam' => ['uptime' => '2h', 'price' => 15000, 'validity' => '1hari'],
            '3jam' => ['uptime' => '3h', 'price' => 20000, 'validity' => '1hari'],
            '5jam' => ['uptime' => '5h', 'price' => 25000, 'validity' => '2hari'],
        ];

        $sites = [
            'WIDE1-Pintas' => ['email' => 'udibagas@wide.co.id'],
            'WIDE2-Siling' => ['email' => 'udibagas@wide.co.id'],
            'WIDE3-Sayan' => ['email' => 'udibagas@wide.co.id'],
            'WIDE4-Sayan2' => ['email' => 'udibagas@wide.co.id'],
            'WIDE5-KM74' => ['email' => 'udibagas@wide.co.id'],
            'WIDE6-KM101' => ['email' => 'udibagas@wide.co.id'],
            'WIDE7-BinaKarya' => ['email' => 'udibagas@wide.co.id']
        ];

        $site       = $this->choice('Site', array_keys($sites));
        $email      = $this->ask('Email', $sites[$site]['email']);
        $dns        = $this->ask('DNS', 'wide.kalbar');
        $profile    = $this->choice('Profile', array_keys($profiles));
        $uptime     = $profiles[$profile]['uptime'];
        $validity   = $profiles[$profile]['validity'];
        $qty        = $this->ask('Qty', 50);
        $price      = $this->ask('Price', $profiles[$profile]['price']);
        $comment    = 'vc-' . date('d.m.y.h.i.') . time();

        $this->table(
            ['Parameter', 'Value'],
            [
                ['Site', $site],
                ['Email', $email],
                ['DNS', $dns],
                ['Profile', $profile],
                ['Uptime', $uptime],
                ['Validity', $validity],
                ['Qty', $qty],
                ['Price', $price],
                ['Comment', $comment]
            ]
        );

        $this->line('tool fetch url="http://dashboard.wide.co.id/api/voucher/generate\?qty=' . $qty . '&uptime=' . $profile . '&validity=' . $validity . '&price=' . $price . '&site=' . $site . '&dns=' . $dns . '&comment=' . $comment . '&email=' . $email . '" dst-path=voucher.txt; :foreach code in=[:toarray [file get voucher.txt contents]] do={ ip hotspot user add name=$code password=$code profile=' . $profile . ' limit-uptime=' . $uptime . ' comment=' . $comment . '; }; ip hotspot user print where comment=' . $comment);
    }
}
