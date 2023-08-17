<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResortDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resort_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number_range')->nullable();
            $table->integer('percentage')->nullable();
            $table->enum('type', ['All', 'Suite', 'Room'])->default('All');
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
        Schema::dropIfExists('resort_discounts');
    }
}
