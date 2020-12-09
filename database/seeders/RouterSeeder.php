<?php

namespace Database\Seeders;

use App\Models\Router;
use Illuminate\Database\Seeder;

class RouterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Router::create([
            'name' => 'Nanga Pintas',
            'host' => '202.5.113.38',
            'user' => 'widepintas',
            'pass' => 'pontianak2'
        ]);
    }
}
