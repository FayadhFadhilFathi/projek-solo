<?php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'total_price', 'status', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
