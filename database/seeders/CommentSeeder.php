<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $posts = Post::where('is_published', true)->get();

        foreach ($posts as $post) {
            $count = rand(0, 5);

            for ($i = 0; $i < $count; $i++) {
                $post->comments()->create([
                    'user_id' => $users->random()->id,
                    'body' => fake()->sentence(),
                ]);
            }
        }

        $pinned = Post::where('is_pinned', true)->firstOrFail();

        $lola = User::where(
            'email',
            'lola.maligad@bulletin.test'
        )->firstOrFail();

        $pinned->comments()->create([
            'user_id' => $lola->id,
            'body' => 'Happy birthday! Wishing everyone a wonderful celebration.',
        ]);

        Comment::factory()->count(2)->make()->each(
            function ($comment) use ($pinned, $users) {
                $pinned->comments()->create([
                    'user_id' => $users->random()->id,
                    'body' => $comment->body,
                ]);
            }
        );
    }
}
