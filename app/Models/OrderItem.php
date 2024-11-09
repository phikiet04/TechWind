<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrderItem extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quantity',
        'price',
        'total_price',
        'order_id',
        'product_id',
        'variant_id',   // Thêm variant_id để lưu ID của biến thể sản phẩm
        'size',          // Thêm size để lưu kích thước sản phẩm
        'color',
    ];
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class); // An order item belongs to an order
    }
}