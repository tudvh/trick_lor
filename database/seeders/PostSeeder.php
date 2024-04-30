<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = [2, 3, 4];
        $posts = Post::all();

        foreach ($posts as $post) {
            $post->update(['author_id' => Arr::random($userIds)]);
        }
    }
}
