<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NearbyClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nearby_clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->string('merchant_id');
            $table->string('time_of_last_update');
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
        Schema::table('nearby_clients', function (Blueprint $table) {
        });
    }
}
