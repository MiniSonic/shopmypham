<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->truncate();
        $data = [
            'username' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '1234567890',
            'password' => bcrypt('123456'),
        ];
        DB::table('user')->insert($data);
    }
}