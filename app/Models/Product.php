<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
            'name', 'description', 'price', 'stock', 'image', 'download_file',
            'category_id', 'type_id' // Tambahkan ini
        ];  

        public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // Scope untuk filter berdasarkan kategori
    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    // Scope untuk filter berdasarkan type
    public function scopeByType($query, $typeSlug)
    {
        return $query->whereHas('type', function ($q) use ($typeSlug) {
            $q->where('slug', $typeSlug);
        });
    }


    // Relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship with orders (direct relationship)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Helper method to check if product has sufficient stock
    public function hasStock($quantity)
    {
        return $this->stock >= $quantity;
    }

    // Helper method to reduce stock with validation
    public function reduceStock($quantity)
    {
        if (!$this->hasStock($quantity)) {
            throw new Exception("Stock tidak mencukupi untuk {$this->name}. Stock tersedia: {$this->stock}, diminta: {$quantity}");
        }

        $this->decrement('stock', $quantity);
        return $this;
    }

    // Helper method to add stock (untuk restock)
    public function addStock($quantity)
    {
        $this->increment('stock', $quantity);
        return $this;
    }

    // Check if product is out of stock
    public function isOutOfStock()
    {
        return $this->stock <= 0;
    }

    // Check if product is low stock (optional - bisa diatur threshold)
    public function isLowStock($threshold = 5)
    {
        return $this->stock <= $threshold && $this->stock > 0;
    }

    // Get formatted price for display
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Scope for products in stock
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Scope for products out of stock
    public function scopeOutOfStock($query)
    {
        return $query->where('stock', '<=', 0);
    }

    // Scope for low stock products
    public function scopeLowStock($query, $threshold = 5)
    {
        return $query->where('stock', '<=', $threshold)->where('stock', '>', 0);
    }

    public function reviews()
{
    return $this->hasMany(Review::class)->where('status', 'approved');
}

public function averageRating()
{
    return $this->reviews()->avg('rating') ?? 0;
}

public function reviewsCount()
{
    return $this->reviews()->count();
}
}