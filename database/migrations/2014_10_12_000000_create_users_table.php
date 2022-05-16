<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('facility_id');
            $table->string('username');
            $table->string('password');
            $table->string('level')->nullable();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('title')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->unique();
            $table->string('accrediation_no')->nullable();
            $table->string('accrediation_validity')->nullable();
            $table->string('license_no')->nullable();
            $table->string('prefix')->nullable();
            $table->string('picture')->nullable();
            $table->string('designation')->nullable();
            $table->string('status')->nullable();
            $table->string('last_login')->nullable();
            $table->string('login_status')->nullable();
            $table->integer('void')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
