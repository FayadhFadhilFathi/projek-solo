<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_address')->nullable()->after('status'); // Menambah kolom alamat
            $table->string('payment_method')->default('cash')->after('delivery_address'); // Menambah metode pembayaran
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('delivery_address');
            $table->dropColumn('payment_method');
        });
    }
};
