<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function show(Author $author)
    {
        $posts = $author->posts()
            ->where('is_published', true)
            ->with(['author', 'tags'])
            ->withCount('comments')
            ->latest('published_at')
            ->get();

        $commentsCount = $author->comments()->count();

        return view('authors.show', compact(
            'author',
            'posts',
            'commentsCount'
        ));
    }
}
