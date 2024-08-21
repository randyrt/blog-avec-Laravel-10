<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence;
        $content = fake()->paragraphs(asText: true);
        $date = fake()->dateTimeBetween('-1 year');

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => Str::limit($content, 150),
            'content' => fake()->paragraphs(asText: true),
            'thumbnail' => fake()->imageUrl,
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}

