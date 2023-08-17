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
            $table->string('model')->nullable();
            $table->integer('passenger_capacity')->nullable();
            $table->text('about')->nullable();
            $table->string('curr')->nullable();
            $table->string('price')->nullable();
            $table->text('img_1')->nullable();
            $table->longtext('images')->nullable();
            $table->string('map_location')->nullable();
            $table->text('address')->nullable();
            $table->longtext('youtube')->nullable();
            $table->string('duration')->default('hour');
            $table->boolean('available')->default(true);
            $table->boolean('subscribed')->default(false);
             // $table->string('sub_exp')->nullable();
             $table->foreignId('business_id')->nullable()->constrained('business_details')->onDelete('cascade')->onUpdate('cascade');
             $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
