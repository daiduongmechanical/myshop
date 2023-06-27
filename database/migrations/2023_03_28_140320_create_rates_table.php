<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('rateid');
            $table->integer('mark')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('userid');
            $table->unsignedInteger('dishid');
            $table->integer('orderid');
            $table->softDeletes('cascade');
            $table->softDeletes(); //addd soft delete
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('dishid')->references('dishid')->on('dishes')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE rates AUTO_INCREMENT=300000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
