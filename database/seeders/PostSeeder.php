<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::all();

        Post::factory()->count(40)
            ->sequence(fn ($seq) => [
                'author_id' => $authors->random()->id
            ])
            ->create();

        Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => [
                'author_id' => $authors->random()->id
            ])
            ->create();

        $kagawad = Author::where(
            'email',
            'kagawad.maligad@bulletin.test'
        )->firstOrFail();

        Post::create([
            'author_id' => $kagawad->id,
            'title' => 'Purok Maligad Clean-up Drive',
            'category' => 'Announcement',
            'body' => 'Residents of Purok Maligad are invited to participate in a community clean-up drive to help maintain a clean and safe neighborhood.',
            'is_published' => true,
            'is_pinned' => true,
            'published_at' => '2026-09-16',
            'views' => 0,
        ]);
    }
}
