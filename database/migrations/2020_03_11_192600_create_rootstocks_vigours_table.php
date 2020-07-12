<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootstocksVigoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rootstocks_vigours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rootstock_id')->unsigned();
            $table->bigInteger('rootstock_relativeto_id')->unsigned();
            $table->float('ratio')->unsigned();
            $table->string('link_source')->nullable();
            $table->string('link_comment')->nullable();

            $table->timestamps();

            $table->foreign('rootstock_id')->references('id')->on('rootstocks');
            $table->foreign('rootstock_relativeto_id')->references('id')->on('rootstocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rootstocks_vigours');
    }
}
