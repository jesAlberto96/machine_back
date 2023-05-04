<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => "water",
            'path_img' => "water.png",
            'amount' => 5,
            'price' => 0.65,
        ]);
        \App\Models\Product::create([
            'name' => "Juice",
            'path_img' => "juice.png",
            'amount' => 5,
            'price' => 1.0,
        ]);
        \App\Models\Product::create([
            'name' => "Soda",
            'path_img' => "soda.png",
            'amount' => 5,
            'price' => 1.50,
        ]);
        \App\Models\Product::create([
            'name' => "Chocolate",
            'path_img' => "chocolate.png",
            'amount' => 5,
            'price' => 0.25,
        ]);
        \App\Models\Product::create([
            'name' => "Cocacola",
            'path_img' => "cocacola.png",
            'amount' => 5,
            'price' => 1,
        ]);
        \App\Models\Product::create([
            'name' => "Cookie",
            'path_img' => "cookie.png",
            'amount' => 5,
            'price' => 0.5,
        ]);
    }
}
