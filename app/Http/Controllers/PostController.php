<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->with(['author', 'tags'])
            ->withCount('comments')
            ->where('is_published', true)
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->q . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->when($request->filled('tag'), function ($query) use ($request) {
                $query->whereHas('tags', function ($tagQuery) use ($request) {
                    $tagQuery->where('name', $request->tag);
                });
            })
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(7)
            ->withQueryString();

        $categories = Post::query()
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $tags = Tag::orderBy('name')->get();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    
public function show($id)
{
    $post = Post::findOrFail($id);

    if (!$post->is_published) {
        abort(404);
    }

    $post->increment('views');

    $post->load([
        'author',
        'tags',
        'comments' => function ($query) {
            $query->latest()->with('user');
        },
    ]);

    return view('posts.show', compact('post'));
}


public function create()
{
    abort_unless(auth()->user()->author()->exists(), 403);

    $categories = [
        'Announcement',
        'Health',
        'Peace & Order',
        'Ayuda',
        'Community Events',
    ];

    $tags = Tag::orderBy('name')->get();

    return view('posts.create', compact('categories', 'tags'));
}


public function store(StorePostRequest $request)
{
    $data = $request->validated();

    $isPublished = $request->boolean('is_published');

    $post = $request->user()->author()
        ->firstOrFail()
        ->posts()
        ->create([
            ...Arr::except($data, ['tags', 'is_published']),
            'is_published' => $isPublished,
            'is_pinned' => false,
            'published_at' => $isPublished ? now() : null,
            'views' => 0,
        ]);

    $post->tags()->sync($data['tags']);

    return redirect()
        ->route('posts.index')
        ->with('status', 'Post saved.');
}



}
