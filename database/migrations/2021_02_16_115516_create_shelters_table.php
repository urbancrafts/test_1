<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('location')->nullable();
            $table->text('address')->nullable();
            $table->text('descr')->nullable();
            $table->string('price')->nullable();
            $table->string('curr')->nullable();
            $table->text('img_1')->nullable();
            $table->longtext('images')->nullable();
            $table->text('youtube')->nullable();
            $table->integer('created_by');
            $table->string('duration')->default('24 hours');
            $table->boolean('available')->default('1');
            $table->boolean('subscribed')->default('0');
            $table->string('sub_exp')->nullable();
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
        Schema::dropIfExists('shelters');
    }
}
