<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shelter_id')->nullable();
            $table->integer('room_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('sub_room_id')->nullable();
            $table->string('type')->default('room');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('id_no')->nullable();
            $table->string('checkin')->nullable();
            $table->string('checkout')->nullable();
            $table->string('duration')->nullable();
            $table->string('adults')->default('1')->nullable();
            $table->string('children')->default('0')->nullable();
            $table->string('member')->default('no');
            $table->string('curr')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->boolean('opened')->default('0');
            $table->integer('paid')->nullable();
            $table->boolean('approved')->default('0');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
