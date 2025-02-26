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
        $table->unsignedBigInteger('user_id'); // ID pengguna
        $table->decimal('total_price', 10, 2); // Total harga
        $table->string('status')->default('pending'); // Status pesanan
        $table->timestamps();
    });
}

};
