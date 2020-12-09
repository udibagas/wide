<?php

namespace App\Console\Commands;

use App\Models\Router;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use RouterOS\Client;
use RouterOS\Query;

class Trx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trx:get {owner?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get transaction and save to local DB';

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
        $routers = Router::all();

        foreach ($routers as $router) {
            $this->getData($router);
        }
    }

    protected function getData(Router $router)
    {
        $client = new Client([
            'host' => $router->host,
            'user' => $router->user,
            'pass' => $router->pass
        ]);

        $owner = $this->argument('owner') ?: strtolower(date('M')) . date('Y');
        $query = (new Query('/system/script/print'))->where('owner', $owner);
        $response = $client->query($query)->read();

        $data = collect($response)->map(function ($item) use ($router) {
            $name = explode('-|-', $item['name']);
            return [
                'router_id' => $router->id,
                // 'date' => $name[0],
                'time' => $this->convertDate($name[0], $name[1]),
                'code' => $name[2],
                'price' => $name[3],
                'ip' => $name[4],
                'mac' => $name[5],
                'validity' => $name[6],
                'profile' => $name[7],
                'comment' => $name[8],
            ];
        });

        DB::transaction(function () use ($data) {
            foreach ($data as $d) {
                Transaction::updateOrCreate([
                    'code' => $d['code'],
                    'price' => $d['price'],
                    'profile' => $d['profile'],
                    'comment' => $d['comment'],
                ], $d);
            }
        });

        $this->info(number_format(Transaction::sum('price')));
    }

    protected function convertDate($date, $time)
    {
        $dateExplode = explode('/', $date);
        return date('Y-m-d H:i:s', strtotime($dateExplode[2] . '-' . Carbon::parse($dateExplode[0])->format('m') . '-' . $dateExplode[1] . ' '  . $time));
    }
}
