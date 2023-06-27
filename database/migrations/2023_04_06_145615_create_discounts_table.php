<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('discountid');
            $table->string('discountname');
            $table->integer('discountamount');
            $table->date('startdate');
            $table->date('enddate');
            $table->string('object');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE discounts AUTO_INCREMENT=400000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
