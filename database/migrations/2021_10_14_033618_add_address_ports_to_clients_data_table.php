<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressPortsToClientsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_data', function (Blueprint $table) {
            $table->string('container_address')->after('dob')->nullable();
            $table->string('lightning_port')->after('container_address')->nullable();
            $table->string('mws_port')->after('lightning_port')->nullable();
            $table->string('pws_port')->after('mws_port')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_data', function (Blueprint $table) {
             $table->dropColumn('container_address');
            $table->dropColumn('lightning_port');
            $table->dropColumn('mws_port');
            $table->dropColumn('pws_port');
        });
    }
}
