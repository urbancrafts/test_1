<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shelter_id');
            $table->string('room_no');
            $table->text('descr')->nullable();
            $table->integer('qnty')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('amount');
            $table->string('curr');
            $table->string('duration')->default('24 hours');
            $table->boolean('available')->default('1');
            $table->text('img_1')->nullable();
            $table->longtext('images')->nullable();
            $table->text('location')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
