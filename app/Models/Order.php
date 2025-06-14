<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'total_price', 'status', 'quantity'];

    protected $casts = [
        'total_price' => 'decimal:2'
    ];

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope for pending orders
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for paid orders
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    // Scope for cancelled orders
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    // Helper method to check if order is pending
    public function isPending()
    {
        return $this->status === 'pending';
    }

    // Helper method to check if order is paid
    public function isPaid()
    {
        return $this->status === 'paid';
    }

    // Helper method to mark order as paid
    public function markAsPaid()
    {
        $this->update(['status' => 'paid']);
        return $this;
    }

    // Helper method to cancel order
    public function cancel()
    {
        $this->update(['status' => 'cancelled']);
        return $this;
    }

    // Get formatted total price
    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}