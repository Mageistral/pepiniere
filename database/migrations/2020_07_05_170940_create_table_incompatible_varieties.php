<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableIncompatibleVarieties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incompatible_varieties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('variety_id')->unsigned();
            $table->bigInteger('rootstock_id')->unsigned();

            $table->foreign('variety_id')->references('id')->on('varieties');
            $table->foreign('rootstock_id')->references('id')->on('rootstocks');

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
        Schema::dropIfExists('incompatible_varieties');
    }
}
