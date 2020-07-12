<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootstocksSpecificitiesLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rootstocks_specificities_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rootstock_id')->unsigned();
            $table->bigInteger('specificity_id')->unsigned();
            $table->bigInteger('level_id')->unsigned();
            $table->string('link_source')->nullable();
            $table->string('link_comment')->nullable();

            $table->timestamps();

            $table->foreign('rootstock_id')->references('id')->on('rootstocks');
            $table->foreign('specificity_id')->references('id')->on('specificities');
            $table->foreign('level_id')->references('id')->on('levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rootstocks_specificities_levels');
    }
}
