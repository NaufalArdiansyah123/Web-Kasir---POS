<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Makanan', 'description' => 'Produk makanan'],
            ['name' => 'Minuman', 'description' => 'Produk minuman'],
            ['name' => 'Snack', 'description' => 'Produk snack dan camilan'],
            ['name' => 'Elektronik', 'description' => 'Produk elektronik'],
            ['name' => 'Alat Tulis', 'description' => 'Alat tulis dan perlengkapan kantor'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
