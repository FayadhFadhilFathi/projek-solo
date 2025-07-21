<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Category: Games
        $gameCategory = Category::create([
            'name' => 'Games',
            'slug' => 'games',
            'description' => 'Video games for all platforms',
            'icon' => 'bi-controller'
        ]);

        // Types untuk Games
        $gameTypes = [
            ['name' => 'MOBA', 'slug' => 'moba', 'description' => 'Multiplayer Online Battle Arena games'],
            ['name' => 'FPS', 'slug' => 'fps', 'description' => 'First Person Shooter games'],
            ['name' => 'RPG', 'slug' => 'rpg', 'description' => 'Role Playing Games'],
            ['name' => 'Racing', 'slug' => 'racing', 'description' => 'Racing and driving games'],
            ['name' => 'Adventure', 'slug' => 'adventure', 'description' => 'Adventure and exploration games'],
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Sports simulation games'],
            ['name' => 'Strategy', 'slug' => 'strategy', 'description' => 'Strategy and tactical games'],
            ['name' => 'Simulation', 'slug' => 'simulation', 'description' => 'Life and world simulation games']
        ];

        foreach ($gameTypes as $type) {
            Type::create([
                'name' => $type['name'],
                'slug' => $type['slug'],
                'description' => $type['description'],
                'category_id' => $gameCategory->id
            ]);
        }

        // Category: PC Components
        $pcCategory = Category::create([
            'name' => 'PC Components',
            'slug' => 'pc-components',
            'description' => 'Computer hardware and components',
            'icon' => 'bi-pc-display'
        ]);

        // Types untuk PC Components
        $pcTypes = [
            ['name' => 'Laptop', 'slug' => 'laptop', 'description' => 'Portable computers and notebooks'],
            ['name' => 'Desktop', 'slug' => 'desktop', 'description' => 'Desktop computers and workstations'],
            ['name' => 'SSD', 'slug' => 'ssd', 'description' => 'Solid State Drives'],
            ['name' => 'RAM', 'slug' => 'ram', 'description' => 'Random Access Memory'],
            ['name' => 'GPU', 'slug' => 'gpu', 'description' => 'Graphics Processing Units'],
            ['name' => 'CPU', 'slug' => 'cpu', 'description' => 'Central Processing Units'],
            ['name' => 'Motherboard', 'slug' => 'motherboard', 'description' => 'Computer motherboards'],
            ['name' => 'Charger', 'slug' => 'charger', 'description' => 'Power adapters and chargers'],
            ['name' => 'Monitor', 'slug' => 'monitor', 'description' => 'Computer monitors and displays'],
            ['name' => 'Keyboard', 'slug' => 'keyboard', 'description' => 'Computer keyboards'],
            ['name' => 'Mouse', 'slug' => 'mouse', 'description' => 'Computer mice and pointing devices']
        ];

        foreach ($pcTypes as $type) {
            Type::create([
                'name' => $type['name'],
                'slug' => $type['slug'],
                'description' => $type['description'],
                'category_id' => $pcCategory->id
            ]);
        }

        // Category: Gaming Accessories
        $accessoryCategory = Category::create([
            'name' => 'Gaming Accessories',
            'slug' => 'gaming-accessories',
            'description' => 'Gaming peripherals and accessories',
            'icon' => 'bi-headset'
        ]);

        // Types untuk Gaming Accessories
        $accessoryTypes = [
            ['name' => 'Headset', 'slug' => 'headset', 'description' => 'Gaming headsets and headphones'],
            ['name' => 'Controller', 'slug' => 'controller', 'description' => 'Game controllers and gamepads'],
            ['name' => 'Chair', 'slug' => 'chair', 'description' => 'Gaming chairs'],
            ['name' => 'Mousepad', 'slug' => 'mousepad', 'description' => 'Gaming mousepads'],
            ['name' => 'Webcam', 'slug' => 'webcam', 'description' => 'Streaming and gaming webcams'],
            ['name' => 'Microphone', 'slug' => 'microphone', 'description' => 'Gaming and streaming microphones']
        ];

        foreach ($accessoryTypes as $type) {
            Type::create([
                'name' => $type['name'],
                'slug' => $type['slug'],
                'description' => $type['description'],
                'category_id' => $accessoryCategory->id
            ]);
        }

        // Category: Consoles
        $consoleCategory = Category::create([
            'name' => 'Gaming Consoles',
            'slug' => 'gaming-consoles',
            'description' => 'Game consoles and handheld devices',
            'icon' => 'bi-joystick'
        ]);

        // Types untuk Consoles
        $consoleTypes = [
            ['name' => 'PlayStation', 'slug' => 'playstation', 'description' => 'Sony PlayStation consoles'],
            ['name' => 'Xbox', 'slug' => 'xbox', 'description' => 'Microsoft Xbox consoles'],
            ['name' => 'Nintendo', 'slug' => 'nintendo', 'description' => 'Nintendo consoles'],
            ['name' => 'Handheld', 'slug' => 'handheld', 'description' => 'Portable gaming devices']
        ];

        foreach ($consoleTypes as $type) {
            Type::create([
                'name' => $type['name'],
                'slug' => $type['slug'],
                'description' => $type['description'],
                'category_id' => $consoleCategory->id
            ]);
        }
    }
}