<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('cartid');
            $table->unsignedBigInteger('userid');
            $table->unsignedInteger('dishid');
            $table->integer('quantity');
            $table->string('required')->nullable();
            $table->integer('discountid')->nullable();
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('dishid')->references('dishid')->on('dishes')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE carts AUTO_INCREMENT=900000");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
