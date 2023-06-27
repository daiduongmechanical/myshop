<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountdishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discountdishes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('discountid');
            $table->unsignedInteger('dishid');
            $table->softDeletes('cascade');
            $table->timestamps();
            $table->foreign('dishid')->references('dishid')->on('dishes')->onDelete('cascade');
            $table->foreign('discountid')->references('discountid')->on('discounts');
        });
        DB::statement("ALTER TABLE  discountdishes AUTO_INCREMENT=700000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discountdishes');
    }
}
