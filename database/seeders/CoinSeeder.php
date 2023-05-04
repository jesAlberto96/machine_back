<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Coin::create([
            'coin' => 0.05,
            'amount' => 5,
        ]);
        \App\Models\Coin::create([
            'coin' => 0.10,
            'amount' => 5,
        ]);
        \App\Models\Coin::create([
            'coin' => 0.25,
            'amount' => 5,
        ]);
        \App\Models\Coin::create([
            'coin' => 1.0,
            'amount' => 5,
        ]);
    }
}
