<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants_data', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('merchant_maxboost')->nullable();
            $table->string('maxboost_limit')->nullable();
            $table->string('store_name')->nullable();
            $table->string('ssh_ip_port')->nullable();
            $table->string('ssh_username')->nullable();
            $table->string('ssh_password')->nullable();
            $table->boolean('is_own_bitcoin')->nullable();
            $table->string('rpc_username')->nullable();
            $table->string('rpc_password')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            
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
        Schema::dropIfExists('merchants_data');
    }
}
