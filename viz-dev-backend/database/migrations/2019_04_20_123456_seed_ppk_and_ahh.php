<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPpkAndAhh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cities_name = [
            'Kab Bandung Barat', 'Kab Bandung', 'Kab Bekasi', 'Kab Bogor',
            'Kab Ciamis', 'Kab Cianjur', 'Kab Cirebon', 'Kab Garut',
            'Kab Indramayu', 'Kab Karawang', 'Kab Kuningan', 'Kab Majalengka',
            'Kab Pangandaran', 'Kab Purwakarta', 'Kab Subang', 'Kab Sukabumi',
            'Kab Sumedang', 'Kab Tasikmalaya', 'Kota Bandung', 'Kota Banjar',
            'Kota Bekasi', 'Kota Bogor', 'Kota Cimahi', 'Kota Cirebon',
            'Kota Depok', 'Kota Sukabumi', 'Kota Tasikmalaya',
        ];

        $ppk = [
            'Kab Bandung Barat' => [6702, 6788, 6975, 7112, 7188, 7522, 7698],
            'Kab Bandung' => [8740, 8797, 8845, 8977, 8998, 9375, 9580],
            'Kab Bekasi' => [9880, 9945, 10040, 10207, 10231, 10322, 10435],
            'Kab Bogor' => [8951, 8960, 9000, 9040, 9065, 9368, 9537],
            'Kab Ciamis' => [7887, 7951, 8007, 8147, 8162, 8295, 8432],
            'Kab Cianjur' => [6430, 6495, 6552, 6694, 6733, 6876, 7074],
            'Kab Cirebon' => [8866, 8889, 8904, 9002, 9013, 9261, 9463],
            'Kab Garut' => [6149, 6195, 6233, 6354, 6372, 6875, 7079],
            'Kab Indramayu' => [8298, 8355, 8404, 8644, 8667, 8768, 8866],
            'Kab Karawang' => [9441, 9524, 9671, 9755, 9768, 10216, 10379],
            'Kab Kuningan' => [8205, 8231, 8248, 8348, 8393, 8516, 8580],
            'Kab Majalengka' => [7918, 7987, 8048, 8193, 8233, 8477, 8594],
            'Kab Pangandaran' => [0, 0, 0, 8199, 8232, 8265, 8312],
            'Kab Purwakarta' => [9684, 10110, 10332, 10492, 10520, 10549, 10732],
            'Kab Subang' => [8973, 9048, 9115, 9266, 9286, 9830, 10012],
            'Kab Sukabumi' => [7658, 7683, 7700, 7800, 7824, 7848, 8077],
            'Kab Sumedang' => [8598, 8652, 8698, 8828, 8844, 9279, 9339],
            'Kab Tasikmalaya' => [6620, 6663, 6699, 6818, 6830, 6934, 7081],
            'Kota Bandung' => [14628, 14699, 14762, 14957, 15048, 15608, 15805],
            'Kota Banjar' =>  [9051, 9120, 9219, 9401, 9438, 9475, 9815],
            'Kota Bekasi' => [14163, 14186, 14342, 14475, 14558, 15115, 15236],
            'Kota Bogor' => [10147, 10265, 10439, 10488, 10532, 10576, 10662],
            'Kota Cimahi' => [10363, 10428, 10473, 10622, 10680, 11011, 11141],
            'Kota Cirebon' => [10285, 10331, 10369, 10563, 10606, 10732, 10824],
            'Kota Depok' => [13747, 13839, 14079, 14160, 14238, 14424, 14560],
            'Kota Sukabumi' => [9294, 9411, 9466, 9608, 9640, 9729, 9819],
            'Kota Tasikmalaya' => [7827, 7908, 8013, 8157, 8210, 8784, 9145],
        ];

        $ahh = [
            'Kab Bandung Barat' => [68.65, 68.68, 68.71, 69.23, 71.56, 71.76, 71.82],
            'Kab Bandung' => [69.02, 69.1, 69.17, 69.37, 72.97, 73.07, 73.1],
            'Kab Bekasi' => [69.4, 69.73, 70.07, 70.45, 73.16, 73.18, 73.24],
            'Kab Bogor' => [68.86, 69.28, 69.7, 70.2, 70.49, 70.59, 70.65],
            'Kab Ciamis' => [67.29, 67.47, 67.65, 67.73, 70.34, 70.74, 70.9],
            'Kab Cianjur' => [66, 66.35, 66.7, 66.8, 69.08, 69.28, 69.39],
            'Kab Cirebon' => [65.29, 65.41, 65.52, 66.04, 71.28, 71.38, 71.43],
            'Kab Garut' => [65.6, 66, 66.39, 66.51, 70.49, 70.69, 70.76],
            'Kab Indramayu' => [66.82, 67.23, 67.64, 67.74, 70.29, 70.59, 70.72],
            'Kab Karawang' => [66.7, 67, 67.3, 67.8, 71.45, 71.55, 71.6],
            'Kab Kuningan' => [67.47, 67.59, 67.71, 68.11, 72.24, 72.64, 72.76],
            'Kab Majalengka' => [66.35, 66.62, 66.88, 67.38, 68.66, 69.06, 69.22],
            'Kab Pangandaran' => [0, 0, 0, 66.59, 69.84, 70.24, 70.4],
            'Kab Purwakarta' => [67.06, 67.35, 67.64, 67.74, 69.96, 70.26, 70.34],
            'Kab Subang' => [69.39, 69.54, 69.69, 69.89, 71.22, 71.52, 71.61],
            'Kab Sukabumi' => [67.06, 67.38, 67.7, 67.9, 69.73, 70.03, 70.14],
            'Kab Sumedang' => [67.42, 67.52, 67.63, 68.13, 71.89, 71.91, 71.96],
            'Kab Tasikmalaya' => [67.96, 68.18, 68.4, 68.8, 67.96, 68.36, 68.54],
            'Kota Bandung' => [69.72, 69.78, 69.85, 70.13, 73.8, 73.82, 73.84],
            'Kota Banjar' => [66.26, 66.38, 66.49, 66.89, 70.24, 70.26, 70.33],
            'Kota Bekasi' => [69.64, 69.7, 69.76, 70.16, 74.18, 74.48, 74.55],
            'Kota Bogor' => [68.87, 68.97, 69.07, 69.25, 72.58, 72.88, 72.95],
            'Kota Cimahi' => [69.18, 69.25, 69.32, 69.82, 73.56, 73.58, 73.59],
            'Kota Cirebon' => [68.5, 68.52, 68.54, 69.04, 71.77, 71.79, 71.83],
            'Kota Depok' => [73.1, 73.2, 73.3, 73.6, 73.96, 73.98, 74.01],
            'Kota Sukabumi' => [69.44, 69.7, 69.96, 70.36, 71.76, 71.86, 71.9],
            'Kota Tasikmalaya' => [69.86, 70.23, 70.6, 70.8, 70.96, 71.26, 71.37],
        ];

        $cities = array();
        foreach ($cities_name as $city_name) {
            $cities[$city_name] = DB::table('vizdev_cities')->where('name', $city_name)->first()->id;
        }

        $ppk_id = DB::table('vizdev_series')->where('name', 'PPK')->first()->id;
        $ahh_id = DB::table('vizdev_series')->where('name', 'Angka Harapan Hidup')->first()->id;

        foreach ($ppk as $city => $ppk_tahun) {
            $year = 2010;
            foreach($ppk_tahun as $ppk_per_tahun) {
                if ($ppk_per_tahun != 0) {
                    DB::table('vizdev_entries')->insert([
                        'series_id' => $ppk_id,
                        'cities_id' => $cities[$city],
                        'value' => $ppk_per_tahun,
                        'year' => $year,
                    ]);
                }
                $year += 1;
            }
        }

        foreach ($ahh as $city => $ahh_tahun) {
            $year = 2010;
            foreach($ahh_tahun as $ahh_per_tahun) {
                if ($ahh_per_tahun != 0) {
                    DB::table('vizdev_entries')->insert([
                        'series_id' => $ahh_id,
                        'cities_id' => $cities[$city],
                        'value' => $ahh_per_tahun,
                        'year' => $year,
                    ]);
                }
                $year += 1;
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $ppk_id = DB::table('vizdev_series')->where('name', 'PPK')->first()->id;
        $ahh_id = DB::table('vizdev_series')->where('name', 'Angka Harapan Hidup')->first()->id;

        DB::table('vizdev_entries')->where('series_id', $ppk_id)->delete();
        DB::table('vizdev_entries')->where('series_id', $ahh_id)->delete();
    }
}
