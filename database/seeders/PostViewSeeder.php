<?php

namespace Database\Seeders;

use App\Models\PostView;
use Illuminate\Database\Seeder;

class PostViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostView::factory(1000)->create();
    }
}
