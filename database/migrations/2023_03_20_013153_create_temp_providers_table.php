<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_providers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number', 24)->nullable()->unique()->default(null);
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('e_provider_type_id')->nullable()->unsigned();
            $table->string('types');
            $table->longText('description')->nullable();
            $table->string('mobile_number', 50)->nullable();
            $table->double('availability_range', 9, 2)->nullable()->default(0);
            $table->boolean('available')->nullable()->default(1);
            $table->boolean('featured')->nullable()->default(0);
            $table->boolean('accepted')->nullable()->default(0);
            $table->char('api_token', 60)->unique()->nullable()->default(null);
            $table->string('device_token')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->string('paypal_email')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('temp_providers');
    }
}
