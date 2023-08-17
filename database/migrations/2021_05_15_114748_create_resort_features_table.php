<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResortFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resort_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('resort_id')->nullable()->constrained('shelters')->onDelete('cascade')->onUpdate('cascade');
            $table->longtext('features')->nullable();
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
        Schema::dropIfExists('resort_features');
    }
}
