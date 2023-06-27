<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('orderid');
            $table->unsignedBigInteger('userid');
            $table->float('totalcost');
            $table->string('type');
            $table->string('detail');
            $table->string('status');
            $table->float('feeship');
            $table->boolean('checkout')->default(false);
            $table->softDeletes(); //addd soft delete
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('users');
        });
        DB::statement("ALTER TABLE orders AUTO_INCREMENT=200000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oders');
    }
}
