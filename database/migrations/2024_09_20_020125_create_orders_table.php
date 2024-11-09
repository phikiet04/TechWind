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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('status');
            $table->string('name');         // Tên người nhận
            $table->string('email');        // Email người nhận
            $table->string('phone');        // Số điện thoại người nhận
            $table->string('address');      // Địa chỉ người nhận
            $table->timestamps();

            $table->unsignedBigInteger('user_id');  // Dùng kiểu dữ liệu unsignedBigInteger
            $table->foreign('user_id')->references(columns: 'id')->on('users')->onDelete('cascade');  // Khoá ngoại với cascade khi xóa category


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};