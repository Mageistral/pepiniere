<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootstocksFruitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rootstocks_fruits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rootstock_id')->unsigned();
            $table->bigInteger('fruit_id')->unsigned();
            $table->timestamps();

            $table->foreign('rootstock_id')->references('id')->on('rootstocks');
            $table->foreign('fruit_id')->references('id')->on('fruits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rootstocks_fruits');
    }
}
