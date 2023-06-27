<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishingredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dishid');
            $table->string('ingredientcode');
            $table->integer('mass');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('dishid')->references('dishid')->on('dishes')->onDelete('cascade');
            $table->foreign('ingredientcode')->references('ingredientcode')->on('warehouses');
        });
        DB::statement("ALTER TABLE dishingredients AUTO_INCREMENT=600000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishingredients');
    }
}
