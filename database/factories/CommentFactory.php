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

    public function definition(): array
    {
        $parentCommentId = null;

        if (Comment::count() > 0) {
            $existingCommentId = Comment::inRandomOrder()->first()->id;
            $parentCommentId = $this->faker->boolean(50) ? null : $existingCommentId;
        }

        return [
            'user_name' => $this->faker->userName,
            'email' => $this->faker->email,
            'home_page' => $this->faker->url,
            'text' => $this->faker->paragraph,
            'file' => $this->faker->imageUrl(),
            'parent_comment_id' => $parentCommentId,
        ];
    }
}
