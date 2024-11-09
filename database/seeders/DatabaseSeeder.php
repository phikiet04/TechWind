<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserMeta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Category::factory(10)->create();
        UserMeta::factory(10)->create();
        Order::factory(10)->create();
        OrderItem::factory(10)->create();
        Blog::factory(10)->create();
        Product::factory()
            ->count(10)
            ->hasVariants(3)
            ->create();

    }
}