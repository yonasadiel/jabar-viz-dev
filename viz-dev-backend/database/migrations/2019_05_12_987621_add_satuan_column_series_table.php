<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSatuanColumnSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vizdev_series', function (Blueprint $table) {
            $table->string('unit', 50)->nullable();
        });

        DB::update('update vizdev_series set unit = ? where name = ?', ['jiwa', 'Populasi']);
        DB::update('update vizdev_series set unit = ? where name = ?', ['ribu rupiah', 'PPK']);
        DB::update('update vizdev_series set unit = ? where name = ?', ['tahun', 'Angka Harapan Hidup']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vizdev_series', function (Blueprint $table) {
            $table->dropColumn(['unit']);
        });
    }
}
