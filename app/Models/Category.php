<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Category extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'parent_id',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    // Relationship: A category can have many subcategories (children)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Relationship: A category can have one parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}