@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h1 class="text-3xl font-bold text-green-800">
            {{ $author->name }}
        </h1>

        <p class="text-gray-600 mt-2">
            {{ $author->position }}
        </p>

        <p class="text-green-700 font-semibold mt-4">
            {{ $commentsCount }} comments received
        </p>
    </div>

    <h2 class="text-xl font-bold mb-4">
        Published Posts
    </h2>

    @forelse ($posts as $post)
        <div class="bg-white rounded-xl shadow p-6 mb-4">

            <a href="{{ route('posts.show', $post->id) }}"
               class="text-xl font-bold text-green-800 hover:underline">
                {{ $post->title }}
            </a>

            <p class="text-sm text-gray-500 mt-2">
                {{ $post->category }}
            </p>

            <div class="flex flex-wrap gap-2 mt-3">
                @foreach ($post->tags as $tag)
                    <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
                       class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>

            <p class="text-sm text-gray-500 mt-4">
                {{ $post->comments_count }} comments
            </p>

        </div>
    @empty
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">
                No published posts yet.
            </p>
        </div>
    @endforelse

    <a href="{{ route('posts.index') }}"
       class="inline-block mt-4 text-green-700 font-semibold hover:underline">
        Back to Bulletin
    </a>

</div>
@endsection
