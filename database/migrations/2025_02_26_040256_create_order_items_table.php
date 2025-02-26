<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id'); // Relasi ke tabel orders
        $table->unsignedBigInteger('product_id'); // Relasi ke tabel products
        $table->integer('quantity'); // Jumlah produk
        $table->decimal('price', 10, 2); // Harga per produk
        $table->timestamps();

        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}

};
