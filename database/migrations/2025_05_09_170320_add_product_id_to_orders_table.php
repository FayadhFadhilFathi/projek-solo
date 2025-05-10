<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Check if the column does not exist before adding it
            if (!Schema::hasColumn('orders', 'product_id')) {
                $table->unsignedBigInteger('product_id')->nullable(); // Make it nullable if needed
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            }
        });
    }
    

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
}
