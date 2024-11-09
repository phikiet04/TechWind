<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'view',
        'status',
        'category_id',
    ];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);  // Một sản phẩm có nhiều đánh giá
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $totalStock = $product->variants()->sum('stock');
            $product->status = $totalStock > 0 ? 'in stock' : 'out of stock';
        });

        static::updated(function ($product) {
            $totalStock = $product->variants()->sum('stock');
            $product->status = $totalStock > 0 ? 'in stock' : 'out of stock';
            $product->saveQuietly();
        });
    }
}
