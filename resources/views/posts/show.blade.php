@extends('layouts.app')

@section('content')

<a href="{{ route('posts.index') }}"
   class="text-green-700 font-semibold">
    ← Back to Bulletin
</a>

<article class="bg-white rounded-lg shadow p-6 mt-5">

    <div class="flex flex-wrap gap-2 mb-4">
        <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">
            {{ $post->category }}
        </span>

        @if ($post->is_pinned)
            <span class="bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full">
                Pinned
            </span>
        @endif

        @foreach ($post->tags as $tag)
            <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
               class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>

    <h2 class="text-3xl font-bold mb-3">
        {{ $post->title }}
    </h2>

    <p class="text-sm text-gray-600 mb-2">
        Posted by
        <a href="{{ route('authors.show', $post->author->id) }}"
           class="text-green-700 font-semibold hover:underline">
            {{ $post->author->name }}
        </a>
    </p>

    <p class="text-sm text-gray-500 mb-6">
        Published: {{ $post->published_at?->format('F d, Y') }}
        | Views: {{ $post->views }}
    </p>

    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
        {{ $post->body }}
    </div>

</article>

<section class="bg-white rounded-lg shadow p-6 mt-6">

    <h3 class="text-2xl font-bold mb-5">
        Comments ({{ $post->comments->count() }})
    </h3>

    @if (session('status'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    @forelse ($post->comments as $comment)
        <div class="border-b py-4">
            <p class="font-semibold text-green-800">
                {{ $comment->user->name }}
            </p>

            <p class="text-gray-700 mt-2">
                {{ $comment->body }}
            </p>

            <p class="text-xs text-gray-500 mt-2">
                {{ $comment->created_at->format('M d, Y h:i A') }}
            </p>
        </div>
    @empty
        <p class="text-gray-500">
            No comments yet.
        </p>
    @endforelse

    @auth
        <div class="mt-6">
            <h4 class="text-lg font-semibold mb-3">
                Leave a Comment
            </h4>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <p class="font-semibold mb-2">
                        Please fix the following:
                    </p>
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('comments.store', $post) }}"
                  method="POST">
                @csrf

                <label for="body" class="block font-medium mb-2">
                    Your Comment
                </label>

                <textarea id="body" name="body" rows="4"
                          class="w-full border rounded-lg p-3"
                          placeholder="Write your comment...">{{ old('body') }}</textarea>

                @error('body')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

                <button type="submit"
                        class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg mt-3">
                    Post Comment
                </button>
            </form>
        </div>
    @else
        <p class="mt-6 text-gray-600">
            <a href="{{ route('login') }}"
               class="text-green-700 font-semibold hover:underline">
                Sign in to comment
            </a>
        </p>
    @endauth

</section>

@endsection
