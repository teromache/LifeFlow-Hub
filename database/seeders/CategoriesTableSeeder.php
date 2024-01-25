<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adjust the range based on your needs
        for ($i = 1; $i <= 10; $i++) {
            DB::table('categories')->insert([
                'id' => Str::uuid(),
                'name' => 'Category ' . $i,
                'type' => 'Category Type ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
