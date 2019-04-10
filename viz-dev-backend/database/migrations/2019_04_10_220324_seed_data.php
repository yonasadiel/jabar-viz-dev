<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('vizdev_users')->insert([
            'username' => 'admin',
            'email' => 'vizdevadmin@gmail.com',
            'password' => bcrypt('vizdevadmin4992'),
            'role' => User::ROLE_ADMIN,
        ]);
        DB::table('vizdev_users')->insert([
            'username' => 'sipd',
            'email' => 'vizdevsipd@gmail.com',
            'password' => bcrypt('vizdevsipd8162'),
            'role' => User::ROLE_PEMPROV,
        ]);
        DB::table('vizdev_users')->insert([
            'username' => 'dinas',
            'email' => 'vizdevdinas@gmail.com',
            'password' => bcrypt('vizdevdinas6172'),
            'role' => User::ROLE_DINAS,
        ]);

        $cities = [
            'Kab Bandung Barat',
            'Kab Bandung',
            'Kab Bekasi',
            'Kab Bogor',
            'Kab Ciamis',
            'Kab Cianjur',
            'Kab Cirebon',
            'Kab Garut',
            'Kab Indramayu',
            'Kab Karawang',
            'Kab Kuningan',
            'Kab Majalengka',
            'Kab Pangandaran',
            'Kab Purwakarta',
            'Kab Subang',
            'Kab Sukabumi',
            'Kab Sumedang',
            'Kab Tasimalaya',
            'Kota Bandung',
            'Kota Banjar',
            'Kota Bekasi',
            'Kota Bogor',
            'Kota Cimahi',
            'Kota Cirebon',
            'Kota Depok',
            'Kota Sukabumi',
            'Kota Tasikmalaya',
        ];

        foreach ($cities as $city) {
            DB::table('vizdev_cities')->insert([
                'name' => $city,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('vizdev_users')->truncate();
        DB::table('vizdev_cities')->truncate();
    }
}
