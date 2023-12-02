<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        return [
            'user_id' => rand(3, 22),
            'category_id' =>rand(1, 20),
            'title' => $title = $this->faker->unique()->words(3, true),
            'slug' => Str::slug($title),
            'content'=>$this->faker->realText(),
            'image' => $this->faker->randomElement(['01HGFJTRT35CF3DY4B152YTE8T.jpg', '01HGFK7K7TYWWQR8P0ED633X1T.jpg']),
            'is_published' =>rand(0, 1),
            'is_featured' =>0,
        ];
    }
    
}
