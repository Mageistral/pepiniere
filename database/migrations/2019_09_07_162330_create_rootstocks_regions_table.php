<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootstocksRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rootstocks_regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('region_id')->unsigned();
            $table->bigInteger('rootstock_id')->unsigned();
            $table->timestamps();

            $table->foreign('rootstock_id')->references('id')
                  ->on('rootstocks');
            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rootstocks_regions');
    }
}
