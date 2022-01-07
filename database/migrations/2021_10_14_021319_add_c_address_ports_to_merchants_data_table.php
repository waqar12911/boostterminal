<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCAddressPortsToMerchantsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants_data', function (Blueprint $table) {
            $table->string('container_address')->after('longitude')->nullable();
            $table->string('lightning_port')->after('container_address')->nullable();
            $table->string('mws_port')->after('lightning_port')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants_data', function (Blueprint $table) {
            $table->dropColumn('container_address');
            $table->dropColumn('lightning_port');
            $table->dropColumn('mws_port');
        });
    }
}
