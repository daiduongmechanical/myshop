<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->string('ingredientcode');
            $table->string('name');
            $table->integer('mass');
            $table->timestamps();
            $table->primary('ingredientcode');
        });
        DB::statement('ALTER TABLE warehouses ADD CONSTRAINT check_min_mass CHECK (mass >= 0)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE warehouses DROP CONSTRAINT check_min_mass');
        Schema::dropIfExists('warehouses');
    }
}
