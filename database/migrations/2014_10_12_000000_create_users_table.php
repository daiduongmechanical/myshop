<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('manage')->default(0);
            $table->string('phone')->nullable();
            $table->string('avatar')->default('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZXpBymHiGfTzS3A6OCNgCE0NrtcFhz7ku4g&usqp=CAU');
            $table->string('address')->nullable();
            $table->string('addresscode')->nullable();
            $table->dateTime('dob')->nullable();
            $table->boolean('block')->default(false);
        });
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 000000");
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
