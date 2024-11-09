<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->string('color');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            $table->unsignedBigInteger('order_id');  // Dùng kiểu dữ liệu unsignedBigInteger
            $table->foreign('order_id')->references(columns: 'id')->on('orders')->onDelete('cascade');  // Khoá ngoại với cascade khi xóa category

            $table->unsignedBigInteger('product_id');  // Dùng kiểu dữ liệu unsignedBigInteger
            $table->foreign('product_id')->references(columns: 'id')->on('products')->onDelete('cascade');  // Khoá ngoại với cascade khi xóa category


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};