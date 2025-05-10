<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
            $table->integer('quantity')->default(1); // Jumlah item dalam pesanan
            $table->decimal('total_price', 10, 2)->default(0); // Total harga, dengan nilai default
            $table->string('status')->default('pending'); // Status pesanan, default pending
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};