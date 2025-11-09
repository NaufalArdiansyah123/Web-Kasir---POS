<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Nasi Goreng', 'price' => 15000, 'stock' => 50, 'category_id' => 1],
            ['name' => 'Mie Goreng', 'price' => 12000, 'stock' => 50, 'category_id' => 1],
            ['name' => 'Ayam Bakar', 'price' => 20000, 'stock' => 30, 'category_id' => 1],
            ['name' => 'Teh Botol', 'price' => 5000, 'stock' => 100, 'category_id' => 2],
            ['name' => 'Aqua', 'price' => 3000, 'stock' => 150, 'category_id' => 2],
            ['name' => 'Kopi', 'price' => 8000, 'stock' => 80, 'category_id' => 2],
            ['name' => 'Chitato', 'price' => 10000, 'stock' => 60, 'category_id' => 3],
            ['name' => 'Oreo', 'price' => 7000, 'stock' => 70, 'category_id' => 3],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
