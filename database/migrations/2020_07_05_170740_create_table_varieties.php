<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVarieties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('varieties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('fruit_id')->unsigned();

            $table->foreign('fruit_id')->references('id')->on('fruits');

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
        Schema::dropIfExists('varieties');
    }
}
