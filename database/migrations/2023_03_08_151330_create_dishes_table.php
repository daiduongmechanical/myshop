<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->increments('dishid');
            $table->string('dishname');
            $table->float('dishprice');
            $table->text('description');
            $table->string('type');
            $table->softDeletes(); //addd soft delete
            $table->index('dishid');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE dishes AUTO_INCREMENT=100000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}
