<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $games = [
            ['name' => 'Game 1', 'description' => 'An amazing adventure game.', 'image' => 'https://via.placeholder.com/150'],
            ['name' => 'Game 2', 'description' => 'A thrilling action game.', 'image' => 'https://via.placeholder.com/150'],
            // Tambahkan lebih dari 20 game
        ];

        // Duplikasikan elemen di atas hingga ada lebih dari 20 game.
        for ($i = 3; $i <= 20; $i++) {
            $games[] = [
                'name' => "Game $i",
                'description' => "Description for Game $i",
                'image' => 'https://via.placeholder.com/150'
            ];
        }

        return view('products', compact('games'));
    }
}
