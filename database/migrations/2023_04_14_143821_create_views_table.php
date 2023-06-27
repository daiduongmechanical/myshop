<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->increments('viewid');
            $table->unsignedInteger('dishid');
            $table->unsignedBigInteger('userid');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('dishid')->references('dishid')->on('dishes')->onDelete('cascade');
            $table->foreign('userid')->references('id')->on('users');
        });
        DB::statement("ALTER TABLE rates AUTO_INCREMENT=800000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('views');
    }
}
