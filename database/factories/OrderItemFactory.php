<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Order;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'total_price' => function (array $attributes) {
                return $attributes['quantity'] * $attributes['price'];
            },
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'variant_id' => Variant::factory(),
        ];
    }
}