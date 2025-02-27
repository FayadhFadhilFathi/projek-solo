<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tambahkan semua kolom yang bisa diisi dari form
    protected $fillable = ['name', 'description', 'price', 'stock', 'image'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
