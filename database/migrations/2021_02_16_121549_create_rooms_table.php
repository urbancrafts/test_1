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
            $table->string('room_name');
            $table->enum('type', ['Room', 'Suite'])->default('Room');
            $table->text('descr')->nullable();
            $table->integer('available_number')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('curr');
            $table->string('price');
            $table->text('img_1')->nullable();
            $table->longtext('images')->nullable();
            $table->string('duration')->default('24 hours');
            $table->boolean('available')->default(true);
            $table->foreignId('resort_id')->nullable()->constrained('shelters')->onDelete('cascade')->onUpdate('cascade');
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
