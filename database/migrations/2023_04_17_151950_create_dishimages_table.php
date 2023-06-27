<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishimages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dishid');
            $table->string('imageurl');
            $table->softDeletes(); //addd soft delete
            $table->timestamps();
            $table->foreign('dishid')->references('dishid')->on('dishes')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE rates AUTO_INCREMENT=500000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishimages');
    }
}
