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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text(column: 'description');
            $table->integer('view')->default(0); // Default view count
            $table->string('status');

            $table->unsignedBigInteger('category_id');  // Dùng kiểu dữ liệu unsignedBigInteger
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');  // Khoá ngoại với cascade khi xóa category


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};