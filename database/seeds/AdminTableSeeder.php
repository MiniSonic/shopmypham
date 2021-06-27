<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->truncate();
        $admin = [
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ];
        DB::table('admin')->insert($admin);
    }
}