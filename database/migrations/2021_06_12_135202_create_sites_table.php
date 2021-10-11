<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->point('position')->nullable();
            $table->string('modem_sn')->nullable();
            $table->ipAddress('public_ip_address')->comment('public ip address from provider');
            $table->ipAddress('vpn_ip_address')->comment('vpn ip address');
            $table->tinyInteger('port')->comment('router API port');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() 
    {
        Schema::dropIfExists('sites');
    }
}
