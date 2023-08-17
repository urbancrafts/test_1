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
            $table->text('map_location')->nullable();
            $table->text('address')->nullable();
            $table->text('descr')->nullable();
            $table->string('curr')->nullable();
            $table->string('price')->nullable();
            $table->text('img_1')->nullable();
            $table->longtext('images')->nullable();
            $table->text('youtube')->nullable();
            $table->string('duration')->default('24 hours');
            $table->boolean('available')->default(true);
            $table->boolean('subscribed')->default(false);
            $table->boolean('discount_enabled')->default(false);
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
        Schema::dropIfExists('shelters');
    }
}
