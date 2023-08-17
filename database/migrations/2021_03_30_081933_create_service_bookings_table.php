<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('id_no')->nullable();
            $table->text('id_file_url')->nullable();
            $table->string('duration')->nullable();
            $table->string('booked_date')->nullable();
            // $table->string('member')->default('no');
            // $table->string('curr')->nullable();
            // $table->integer('price')->nullable();
            // $table->integer('discount')->nullable();
            $table->boolean('opened')->default(false);
            $table->boolean('paid')->default(false);
            $table->boolean('vendor_confired_booking')->default(false);
            $table->boolean('customer_confired_service')->default(false);
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('service_bookings');
    }
}
