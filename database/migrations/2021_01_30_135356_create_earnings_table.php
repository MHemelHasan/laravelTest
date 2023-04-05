<?php
/*
 * File name: 2021_01_30_135356_create_earnings_table.php
 * Last modified: 2021.01.30 at 14:55:22
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2021
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEarningsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('total_bookings')->unsigned()->default(0);
            $table->double('total_earning', 10, 2)->default(0);
            $table->double('admin_earning', 10, 2)->default(0);
            $table->double('e_provider_earning', 10, 2)->default(0);
            $table->double('taxes', 10, 2)->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('earnings');
    }
}
