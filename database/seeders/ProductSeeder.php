<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'God Of War',
                'description' => 'God of War[b] is a 2018 action-adventure game developed by Santa Monica Studio and published by Sony...',
                'price' => 1000.00,
                'stock' => 998,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=God+Of+War',
                'download_file' => null
            ],
            [
                'name' => 'E Football 2024',
                'description' => 'eFootball is a football video game developed and published by Konami.',
                'price' => 100.00,
                'stock' => 99,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=E+Football+2024',
                'download_file' => null
            ],
            [
                'name' => 'Resident Evil 4',
                'description' => 'Resident Evil 4, known in Japan as Biohazard 4, is a third-person shooter survival horror video game...',
                'price' => 100.00,
                'stock' => 99,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=Resident+Evil+4',
                'download_file' => null
            ],
            [
                'name' => 'DOTA 2',
                'description' => 'Dota 2 is a 2013 multiplayer online battle arena (MOBA) video game by Valve.',
                'price' => 0.00,
                'stock' => 1000,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=DOTA+2',
                'download_file' => null
            ],
            [
                'name' => 'Counter-Strike 2',
                'description' => 'Counter-Strike 2 (CS2) is a 2023 free-to-play tactical first-person shooter game developed and publi...',
                'price' => 0.00,
                'stock' => 1000,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=Counter-Strike+2',
                'download_file' => null
            ],
            [
                'name' => 'CyberPunk 2077',
                'description' => 'Cyberpunk 2077 is an action RPG video game developed and published by CD Projekt Red',
                'price' => 100.00,
                'stock' => 1000,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=CyberPunk+2077',
                'download_file' => null
            ],
            [
                'name' => 'Black Myth Wukong',
                'description' => 'Black Myth: Wukong is an action role-playing game by Chinese indie developer Game Science, based on...',
                'price' => 100.00,
                'stock' => 999,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=Black+Myth+Wukong',
                'download_file' => null
            ],
            [
                'name' => 'Testing',
                'description' => 'Testing',
                'price' => 1.00,
                'stock' => 1,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=Testing',
                'download_file' => null
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}