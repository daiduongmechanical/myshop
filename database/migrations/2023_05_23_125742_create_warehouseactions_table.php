<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouseactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ingredientcode');
            $table->integer('mass');
            $table->string('description');
            $table->unsignedBigInteger('userid');
            $table->timestamps();
            $table->foreign('ingredientcode')->references('ingredientcode')->on('warehouses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouseactions');
    }
}
