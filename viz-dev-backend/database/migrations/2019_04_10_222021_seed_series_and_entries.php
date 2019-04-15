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
            'Kota Banjar' =>     [9051, 9120, 9219, 9401, 9438, 9475, 9815],
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
        $ppk_id = DB::table('vizdev_series')->where('name', 'PPK')->first()->id;
        $ahh_id = DB::table('vizdev_series')->where('name', 'Angka Harapan Hidup')->first()->id;

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
        DB::table('vizdev_entries')->truncate();
        DB::table('vizdev_series')->truncate();
    }
}
