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
            $table->string('title')->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('unhash_pass')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('dob')->nullable();
            $table->string('img')->nullable();
            $table->text('about')->nullable();
            $table->text('profession')->nullable();
            $table->boolean('role')->default('2');
            $table->string('user_type')->default('member');
            $table->string('privilege')->nullable();
            $table->string('privilege_2')->nullable();
            $table->string('position')->nullable();
            $table->integer('admin')->nullable();
            $table->boolean('dues')->default('0');
            $table->boolean('isActive')->default('1')->nullable();
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
