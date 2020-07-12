<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootstocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rootstocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_alternate')->nullable();
            $table->string('latin_name')->nullable();
            $table->integer('height_mean')->unsigned();
            $table->integer('computed_vigour')->unsigned();
            $table->smallInteger('lifetime')->unsigned()->nullable();
            $table->bigInteger('rootstock1_id')->unsigned()->nullable();
            $table->bigInteger('rootstock2_id')->unsigned()->nullable();
            $table->bigInteger('developer_id')->unsigned()->nullable();
            $table->smallInteger('obtaining_year')->unsigned()->nullable();
            $table->tinyInteger('first_fruits_years')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('rootstock1_id')->references('id')->on('rootstocks');
            $table->foreign('rootstock2_id')->references('id')->on('rootstocks');

            $table->unique('name');
            $table->unique('name_alternate');
            $table->unique('latin_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rootstocks');
    }
}
