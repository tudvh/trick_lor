<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostSave;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 300; $i++) {
            $createdAt = fake()->dateTimeBetween('2020-01-01 00:00:00', now());

            do {
                $user = User::inRandomOrder()->first();
                $post = Post::inRandomOrder()->first();

                $exists = PostSave::where('post_id', $post->id)
                    ->where('user_id', $user->id)
                    ->exists();
            } while ($exists);

            PostSave::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
