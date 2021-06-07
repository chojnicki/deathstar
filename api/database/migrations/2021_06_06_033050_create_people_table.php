<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->unsignedBigInteger('planet_id')->index()->nullable();
            $table->unsignedSmallInteger('height')->nullable();
            $table->unsignedSmallInteger('mass')->nullable();
            $table->string('hair_color', 32)->nullable()->index();
            $table->string('skin_color', 32)->nullable()->index();
            $table->string('eye_color', 32)->nullable()->index();
            $table->string('gender', 16)->nullable()->index();
            $table->smallInteger('born_at')->nullable()->index();
            $table->smallInteger('died_at')->nullable()->index();
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
        Schema::dropIfExists('people');
    }
}
