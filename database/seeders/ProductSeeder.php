<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat data produk menggunakan seeder
        Product::create([
            'name' => 'Product 1',
            'description' => 'Description for Product 1',
            'price' => 100.00,
            'stock' => 50,
            'image' => 'https://example.com/product1.jpg',
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'Description for Product 2',
            'price' => 150.00,
            'stock' => 30,
            'image' => 'https://example.com/product2.jpg',
        ]);

        Product::create([
            'name' => 'Product 3',
            'description' => 'Description for Product 3',
            'price' => 200.00,
            'stock' => 20,
            'image' => 'https://example.com/product3.jpg',
        ]);
    }
}
