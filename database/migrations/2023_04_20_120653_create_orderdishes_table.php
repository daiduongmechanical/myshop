<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderdishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdishes', function (Blueprint $table) {
            $table->increments('orderdishid');
            $table->integer('quantity');
            $table->unsignedInteger('dishid');
            $table->unsignedInteger('orderid');
            $table->string('require')->nullable();
            $table->softDeletes(); //addd soft delete
            $table->unsignedInteger('discountid')->nullable();
            $table->foreign('dishid')->references('dishid')->on('dishes')->onDelete('cascade');
            $table->foreign('orderid')->references('orderid')->on('orders')->onDelete('cascade');

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
        Schema::dropIfExists('orderdishes');
    }
}
