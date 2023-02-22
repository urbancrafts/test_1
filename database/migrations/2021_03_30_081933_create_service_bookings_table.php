<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('id_no')->nullable();
            $table->string('duration')->nullable();
            $table->string('booked_date')->nullable();
            $table->string('member')->default('no');
            $table->string('curr')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->boolean('opened')->default('0');
            $table->boolean('paid')->default('0');
            $table->boolean('approved')->default('0');
            $table->string('created_by')->default('self')->nullable();
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
        Schema::dropIfExists('service_bookings');
    }
}
