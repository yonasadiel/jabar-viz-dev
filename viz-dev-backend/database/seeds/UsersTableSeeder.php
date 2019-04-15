<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
    }
}
