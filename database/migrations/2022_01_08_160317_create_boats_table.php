<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->string('title')->nullable();
            $table->text('about')->nullable();
            $table->string('curr')->nullable();
            $table->string('price')->nullable();
            $table->text('img_1')->nullable();
            $table->longtext('images')->nullable();
            $table->string('location')->nullable();
            $table->text('address')->nullable();
            $table->longtext('youtube')->nullable();
            $table->string('duration')->default('hour');
            $table->boolean('available')->default('1');
            $table->boolean('subscribed')->default('0');
            $table->string('sub_exp')->nullable();
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
        Schema::dropIfExists('boats');
    }
}
