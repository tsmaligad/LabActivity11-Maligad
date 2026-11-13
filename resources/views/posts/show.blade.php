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

    </div>

    <h2 class="text-3xl font-bold mb-3">
        {{ $post->title }}
    </h2>

    <p class="text-sm text-gray-500 mb-6">
        Published: {{ $post->published_at?->format('F d, Y') }}
        | Views: {{ $post->views }}
    </p>

    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
        {{ $post->body }}
    </div>

</article>

@endsection
