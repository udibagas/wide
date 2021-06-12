<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make CRUD API';

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
        $name = $this->argument('name');
        Artisan::call("make:model {$name} -m -c -r --api --force");
        Artisan::call("make:request {$name}Request");
    }
}
