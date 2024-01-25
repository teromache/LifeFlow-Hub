<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adjust the range based on your needs
        for ($i = 1; $i <= 15000; $i++) {
            DB::table('transactions')->insert([
                'id' => Str::uuid(),
                'type' => 'Transaction Type ' . $i,
                'date' => now(),// Assuming you have categories with IDs from 1 to 10
                'amount' => rand(1, 1000),
                'note' => 'Transaction Note ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
