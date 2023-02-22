<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlideFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ref_id')->nullable();
            $table->string('category')->nullable();
            $table->string('name')->nullable();
            $table->text('img_url')->nullable();
            $table->text('url')->nullable();
            $table->boolean('allow')->default('1');
            $table->boolean('updated')->default('1');
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
        Schema::dropIfExists('slide_features');
    }
}
