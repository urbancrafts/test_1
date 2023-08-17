<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->integer('user_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('checkin')->nullable();
            $table->string('checkout')->nullable();
            $table->string('duration')->nullable();
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->string('curr')->nullable();
            $table->integer('price')->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_no')->nullable();
            $table->text('id_file_url')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->boolean('opened')->default(false);
            $table->integer('paid')->nullable();
            $table->boolean('approved')->default(false);
            $table->string('status')->nullable();
            $table->boolean('vendor_confired_booking')->default(false);
            $table->boolean('customer_confired_checkin')->default(false);
            // $table->string('created_by')->default('self')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('cascade')->onUpdate('cascade');
            // $table->integer('resort_id')->nullable()->constrained('shelters')->onDelete('cascade')->onUpdate('cascade');
            // $table->integer('room_id')->nullable()->constrained('rooms')->onDelete('cascade')->onUpdate('cascade');
            // $table->integer('shelter_id')->nullable();
            // $table->integer('room_id')->nullable();
            $table->foreignId('room_number_id')->nullable()->constrained('room_numbers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('reservations');
    }
}
