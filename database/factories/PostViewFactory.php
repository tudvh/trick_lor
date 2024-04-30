<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostView>
 */
class PostViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = fake()->randomElement([0, 1]) ? User::select('id')->inRandomOrder()->first() : null;
        $createdAt = now()->subDays(rand(0, 365 * 5));

        return [
            'user_id' => $userId,
            'post_id' => Post::select('id')->inRandomOrder()->first(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
