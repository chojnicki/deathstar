<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32)->unique();
            $table->integer('rotation_period')->nullable();
            $table->integer('orbital_period')->nullable();
            $table->integer('diameter')->nullable()->index();
            $table->string('climate', 16)->nullable();
            $table->string('gravity', 16)->nullable();
            $table->json('terrains')->nullable();
            $table->integer('surface_water')->nullable();
            $table->bigInteger('population')->nullable()->index();
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
        Schema::dropIfExists('planets');
    }
}
