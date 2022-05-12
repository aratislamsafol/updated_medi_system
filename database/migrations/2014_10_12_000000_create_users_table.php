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
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('user_name');
            $table->integer('phone');
            $table->string('email')->unique();
            $table->string('address');
            $table->tinyInteger('division_id');
            $table->tinyInteger('district_id');
            $table->string('blood_group');
            $table->tinyInteger('age');
            $table->string('gender')->comment('Male,female,others');
            // $table->string('photo');
            $table->tinyInteger('status')->comment('1->active|2->banned|3->suspend');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
