<?php
/*
 * File name: 2021_01_15_115239_create_e_provider_addresses_table.php
 * Last modified: 2021.01.17 at 17:04:35
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2021
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEProviderAddressesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_provider_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->integer('address_id')->unsigned();
            $table->primary(['user_id', 'address_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('e_provider_addresses');
    }
}
