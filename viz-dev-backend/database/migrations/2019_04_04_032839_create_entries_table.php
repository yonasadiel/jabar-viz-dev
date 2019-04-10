<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vizdev_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('series_id');
            $table->unsignedBigInteger('cities_id');
            $table->integer('year');
            $table->float('value', 12, 6);

            $table->foreign('series_id')->references('id')->on('vizdev_series');
            $table->foreign('cities_id')->references('id')->on('vizdev_cities');
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
        Schema::dropIfExists('vizdev_entries');
    }
}
