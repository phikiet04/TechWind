<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(), // Tạo tiêu đề ngẫu nhiên
            'description' => fake()->paragraph(), // Tạo mô tả ngẫu nhiên với nhiều câu
            'content' => fake()->text(2000), // Nội dung bài viết với tối đa 2000 ký tự
            'image' => fake()->imageUrl(640, 480, 'articles', true), // URL hình ảnh ngẫu nhiên
            'user_id' => User::factory(), // Tạo hoặc liên kết với user ngẫu nhiên
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}