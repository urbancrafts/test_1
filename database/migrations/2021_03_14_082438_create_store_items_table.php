<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->string('item_name');
            $table->string('type')->nullable();
            $table->integer('price');
            $table->string('curr');
            $table->string('location')->nullable();
            $table->longtext('youtube')->nullable();
            $table->text('desc')->nullable();
            $table->boolean('discount_opt')->default('0');
            $table->integer('discount_percent')->default('0');
            $table->integer('discount_number')->nullable();
            $table->text('img_1')->nullable();
            $table->longtext('images')->nullable();
            $table->boolean('available')->default('1');
            $table->boolean('subscribed')->default('0');
            $table->string('sub_exp')->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('store_items');
    }
}
