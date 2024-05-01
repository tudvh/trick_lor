<?php

namespace Database\Seeders;

use App\Enums\User\UserStatus;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 200; $i++) {
            $replyId = fake()->randomElement([0, 1])
                ? PostComment::whereNull('reply_id')->inRandomOrder()->first()?->id
                : null;
            $createdAt = fake()->dateTimeBetween('2020-01-01 00:00:00', now());

            PostComment::create([
                'user_id' => User::where('status', '<>', UserStatus::REGISTER)->inRandomOrder()->first()->id,
                'post_id' => Post::inRandomOrder()->first()->id,
                'content' => fake()->text(),
                'reply_id' => $replyId,
                'created_at' =>  $createdAt,
                'updated_at' =>  $createdAt,
            ]);
        }
    }
}
