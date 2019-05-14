<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedSeriesAndEntries extends Migration
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

        $populasi = [
            'Kab Bandung Barat' => [1522076, 1545118, 1567398, 1588781, 1609512, 1629423, 1648387],
            'Kab Bandung' => [3205121, 3272828, 3339684, 3405475, 3470393, 3534114, 3596623],
            'Kab Bekasi' => [2656884, 2769180, 2884300, 3002112, 3122698, 3246013, 3371691],
            'Kab Bogor' => [4813876, 4943746, 5073116, 5202097, 5331149, 5459668, 5587390],
            'Kab Ciamis' => [1135724, 1142230, 1148782, 1155471, 1162102, 1168682, 1175389],
            'Kab Cianjur' => [2186794, 2201003, 2213889, 2225313, 2235418, 2243904, 2250977],
            'Kab Cirebon' => [2044181, 2060400, 2076615, 2093075, 2109588, 2126179, 2142999],
            'Kab Garut' => [2422326, 2450430, 2477114, 2502410, 2526186, 2548723, 2569505],
            'Kab Indramayu' => [1645024, 1654119, 1663397, 1672683, 1682022, 1691386, 1700815],
            'Kab Karawang' => [2144185, 2172289, 2199394, 2225383, 2250120, 2273579, 2295778],
            'Kab Kuningan' => [1023907, 1030205, 1036494, 1042789, 1049084, 1055417, 1061886],
            'Kab Majalengka' => [1153226, 1158882, 1164724, 1170505, 1176313, 1182109, 1188004],
            'Kab Pangandaran' => [379518, 381729, 383915, 386129, 388320, 390483, 392817],
            'Kab Purwakarta' => [859186, 872599, 885386, 898001, 910007, 921598, 932701],
            'Kab Subang' => [1449207, 1464901, 1480708, 1496886, 1513093, 1529388, 1546000],
            'Kab Sukabumi' => [2358418, 2376495, 2393191, 2408417, 2422113, 2434221, 2444616],
            'Kab Sumedang' => [1101578, 1110083, 1117919, 1125125, 1131516, 1137273, 1142097],
            'Kab Tasikmalaya' => [1687776, 1699583, 1710426, 1720123, 1728587, 1735998, 1742276],
            'Kota Bandung' => [2412093, 2429176, 2444617, 2458503, 2470802, 2481469, 2490622],
            'Kota Banjar' => [176506, 177587, 178728, 179706, 180515, 181425, 181901],
            'Kota Bekasi' => [2356100, 2427075, 2498598, 2570397, 2642508, 2714825, 2787205],
            'Kota Bogor' => [958077, 976791, 995081, 1013019, 1030720, 1047922, 1064687],
            'Kota Cimahi' => [545505, 554175, 562721, 570991, 579015, 586580, 594021],
            'Kota Cirebon' => [293206, 295981, 298825, 301728, 304584, 307494, 310486],
            'Kota Depok' => [1755612, 1823182, 1891981, 1962182, 2033508, 2106102, 2179813],
            'Kota Sukabumi' => [301014, 304704, 308405, 311822, 315001, 318117, 321097],
            'Kota Tasikmalaya' => [639987, 644305, 648178, 651676, 654794, 657477, 659606],
        ];

        $cities = array();
        foreach ($cities_name as $city_name) {
            $cities[$city_name] = DB::table('vizdev_cities')->where('name', $city_name)->first()->id;
        }

        DB::table('vizdev_series')->insert([
            'name' => 'Populasi',
            'description' => 'Jumlah penduduk Kab/Kota',
        ]);

        DB::table('vizdev_series')->insert([
            'name' => 'PPK',
            'description' => 'Pendapatan Per Kapita Kab/Kota',
        ]);

        DB::table('vizdev_series')->insert([
            'name' => 'Angka Harapan Hidup',
            'description' => 'Angka Harapan Hidup Kab/Kota',
        ]);

        $populasi_id = DB::table('vizdev_series')->where('name', 'Populasi')->first()->id;

        foreach ($populasi as $city => $populasi_tahun) {
            $year = 2010;
            foreach($populasi_tahun as $populasi_per_tahun) {
                DB::table('vizdev_entries')->insert([
                    'series_id' => $populasi_id,
                    'cities_id' => $cities[$city],
                    'value' => $populasi_per_tahun,
                    'year' => $year,
                ]);
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
        $populasi_id = DB::table('vizdev_series')->where('name', 'Populasi')->first()->id;

        DB::table('vizdev_entries')->where('series_id', $populasi_id)->delete();
        DB::table('vizdev_series')->truncate();
    }
}
