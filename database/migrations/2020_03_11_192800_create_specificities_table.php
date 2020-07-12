<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Les spécificités sont larges comme une résistance à une maladie ou une tolérance à un type de sol
 * Les résistances seront décrites telle que "Résistance à (maladie)" et non "Sensible à (maladie)"
 * On pourra aussi trouver, en description positive "Favorise le calibre des fruits", qui sera à un niveau plus bas que moyennement pour une mauvaise influence sur le calibre.
 */
class CreateSpecificitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specificities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('category_id')->unsigned();

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('specificities_categories');

            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specificities');
    }
}
