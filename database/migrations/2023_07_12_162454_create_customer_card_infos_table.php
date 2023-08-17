<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCardInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_card_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('card_type')->nullable();
            $table->string('card_number')->nullable();
            $table->string('exp_month')->nullable();
            $table->string('exp_year')->nullable();
            $table->string('cvv_code')->nullable();
            $table->string('name_on_card')->nullable();
            $table->string('card_pin')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('customer_card_infos');
    }
}
