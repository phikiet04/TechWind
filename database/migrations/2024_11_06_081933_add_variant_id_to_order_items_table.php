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
        Schema::table('order_items', function (Blueprint $table) {
            // Thêm cột 'variant_id' và thiết lập khóa ngoại
            $table->unsignedBigInteger('variant_id')->nullable(); // Dùng nullable nếu không bắt buộc phải có
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Xóa khóa ngoại và cột 'variant_id' khi rollback migration
            $table->dropForeign(['variant_id']); // Xóa khóa ngoại
            $table->dropColumn('variant_id'); // Xóa cột
        });
    }
};
