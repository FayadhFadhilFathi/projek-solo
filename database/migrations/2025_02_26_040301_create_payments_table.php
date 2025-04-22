<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id'); // Relasi ke tabel orders
        $table->string('payment_method'); // Metode pembayaran
        $table->decimal('amount', 10, 2); // Jumlah pembayaran
        $table->string('status')->default('pending'); // Status pembayaran
        $table->timestamps();

        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    });
}

};
