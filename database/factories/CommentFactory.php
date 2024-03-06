<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{

    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $existingComment = Comment::inRandomOrder()->first(); // Retrieve a random existing comment

        return [
            'user_name' => $this->faker->userName,
            'email' => $this->faker->email,
            'home_page' => $this->faker->url,
            'text' => $this->faker->paragraph,
            'file' => $this->faker->imageUrl(),
            'parent_comment_id' => $existingComment ? $existingComment->id : null
        ];
    }
}
