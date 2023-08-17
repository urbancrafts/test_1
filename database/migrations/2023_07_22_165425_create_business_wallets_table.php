<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('curr')->nullable();
            $table->integer('pending_balance')->default(0);
            $table->integer('current_balance')->default(0);
            $table->foreignId('business_id')->nullable()->constrained('business_details')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('business_wallets');
    }
}
