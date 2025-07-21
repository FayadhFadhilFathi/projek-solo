<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Create or get categories with fallback
        $gameCategory = $this->getOrCreateCategory(
            'Games', 
            'games', 
            'Video games for all platforms', 
            'bi-controller'
        );

        $pcCategory = $this->getOrCreateCategory(
            'PC Components', 
            'pc-components', 
            'Computer hardware and components', 
            'bi-pc-display'
        );

        $consoleCategory = $this->getOrCreateCategory(
            'Gaming Consoles', 
            'gaming-consoles', 
            'Game consoles and handheld devices', 
            'bi-joystick'
        );

        $accessoryCategory = $this->getOrCreateCategory(
            'Gaming Accessories', 
            'gaming-accessories', 
            'Gaming peripherals and accessories', 
            'bi-headset'
        );

        // Create or get types with fallback
        $mobaType = $this->getOrCreateType(
            'MOBA', 
            'moba', 
            'Multiplayer Online Battle Arena games', 
            $gameCategory->id
        );

        $fpsType = $this->getOrCreateType(
            'FPS', 
            'fps', 
            'First Person Shooter games', 
            $gameCategory->id
        );

        $rpgType = $this->getOrCreateType(
            'RPG', 
            'rpg', 
            'Role Playing Games', 
            $gameCategory->id
        );

        $sportsType = $this->getOrCreateType(
            'Sports', 
            'sports', 
            'Sports simulation games', 
            $gameCategory->id
        );

        $laptopType = $this->getOrCreateType(
            'Laptop', 
            'laptop', 
            'Portable computers and notebooks', 
            $pcCategory->id
        );

        $headsetType = $this->getOrCreateType(
            'Headset', 
            'headset', 
            'Gaming headsets and headphones', 
            $accessoryCategory->id
        );

        $playstationType = $this->getOrCreateType(
            'PlayStation', 
            'playstation', 
            'Sony PlayStation consoles', 
            $consoleCategory->id
        );

        $products = [
            [
                'name' => 'God Of War',
                'description' => 'God of War[b] is a 2018 action-adventure game developed by Santa Monica Studio and published by Sony...',
                'price' => 1000.00,
                'stock' => 998,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=God+Of+War',
                'download_file' => null,
                'category_id' => $gameCategory->id,
                'type_id' => $rpgType->id
            ],
            [
                'name' => 'E Football 2024',
                'description' => 'eFootball is a football video game developed and published by Konami.',
                'price' => 100.00,
                'stock' => 99,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=E+Football+2024',
                'download_file' => null,
                'category_id' => $gameCategory->id,
                'type_id' => $sportsType->id
            ],
            [
                'name' => 'DOTA 2',
                'description' => 'Dota 2 is a 2013 multiplayer online battle arena (MOBA) video game by Valve.',
                'price' => 0.00,
                'stock' => 1000,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=DOTA+2',
                'download_file' => null,
                'category_id' => $gameCategory->id,
                'type_id' => $mobaType->id
            ],
            [
                'name' => 'Counter-Strike 2',
                'description' => 'Counter-Strike 2 (CS2) is a 2023 free-to-play tactical first-person shooter game developed and published...',
                'price' => 0.00,
                'stock' => 1000,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=Counter-Strike+2',
                'download_file' => null,
                'category_id' => $gameCategory->id,
                'type_id' => $fpsType->id
            ],
            [
                'name' => 'Gaming Laptop ASUS ROG',
                'description' => 'High-performance gaming laptop with RTX 4060 and Intel i7 processor',
                'price' => 15000000.00,
                'stock' => 10,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=ASUS+ROG+Laptop',
                'download_file' => null,
                'category_id' => $pcCategory->id,
                'type_id' => $laptopType->id
            ],
            [
                'name' => 'Wireless Gaming Headset',
                'description' => '7.1 surround sound wireless gaming headset with noise cancellation',
                'price' => 1200000.00,
                'stock' => 25,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=Gaming+Headset',
                'download_file' => null,
                'category_id' => $accessoryCategory->id,
                'type_id' => $headsetType->id
            ],
            [
                'name' => 'PlayStation 5',
                'description' => 'Next-gen gaming console with ultra-high speed SSD',
                'price' => 8000000.00,
                'stock' => 15,
                'image' => 'https://via.placeholder.com/640x480.png/007bff/ffffff?text=PS5',
                'download_file' => null,
                'category_id' => $consoleCategory->id,
                'type_id' => $playstationType->id
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }

    /**
     * Get or create a category
     */
    protected function getOrCreateCategory($name, $slug, $description, $icon)
    {
        return Category::firstOrCreate(
            ['slug' => $slug],
            [
                'name' => $name,
                'description' => $description,
                'icon' => $icon
            ]
        );
    }

    /**
     * Get or create a type
     */
    protected function getOrCreateType($name, $slug, $description, $categoryId)
    {
        return Type::firstOrCreate(
            ['slug' => $slug],
            [
                'name' => $name,
                'description' => $description,
                'category_id' => $categoryId
            ]
        );
    }
}