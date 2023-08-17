<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referrer_code')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('none_hsh')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('dob')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Others'])->default('Male');
            $table->string('profile_img_url')->nullable();
            $table->enum('user_type', ['Customer', 'Business', 'Admin'])->default('Customer');
            $table->boolean('is_email_verified')->default(false);
            $table->boolean('is_business_verified')->default(false);
            $table->enum('status', ['Pending', 'Active','Blocked','Suspended','Deleted'])->default('Pending');
            $table->boolean('security_2fa')->default(false);
            $table->boolean('security_question')->default(false);
            $table->boolean('security_pin')->default(false);
            $table->string('admin_user')->nullable();
            $table->boolean('loggedIn')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
