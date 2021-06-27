<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->truncate();
        $data = [
            ['id' => 1, 'name' => 'nike', 'slug' => 'nike', 'parent_id' => ''],
            ['id' => 2, 'name' => 'adidas', 'slug' => 'adidas', 'parent_id' => ''],
            ['id' => 3, 'name' => 'puma', 'slug' => 'puma', 'parent_id' => ''],
            ['id' => 4, 'name' => 'mizuno', 'slug' => 'mizuno', 'parent_id' => ''],
        ];
        DB::table('category')->insert($data);
    }
}