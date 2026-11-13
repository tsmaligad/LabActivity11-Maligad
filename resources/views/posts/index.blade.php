@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    Latest Barangay Announcements
</h2>

<form method="GET" action="{{ route('posts.index') }}"
      class="bg-white rounded-lg p-4 shadow mb-6 flex flex-col sm:flex-row gap-3">

    <input type="text" name="q"
           value="{{ request('q') }}"
           placeholder="Search title"
           class="border rounded px-3 py-2 flex-1">

    <select name="category" class="border rounded px-3 py-2">
        <option value="">All Categories</option>

        @foreach ($categories as $c)
            <option value="{{ $c }}"
                @selected(request('category') == $c)>
                {{ $c }}
            </option>
        @endforeach
    </select>

    <button type="submit"
            class="bg-green-700 text-white rounded px-5 py-2">
        Filter
    </button>

    <a href="{{ route('posts.index') }}"
       class="border rounded px-4 py-2 text-center">
        Clear
    </a>
</form>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    @forelse ($posts as $post)

        <article class="bg-white rounded-lg shadow p-5">

            <div class="flex flex-wrap items-center gap-2 mb-3">

                <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full">
                    {{ $post->category }}
                </span>

                @if ($post->is_pinned)
                    <span class="bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full">
                        Pinned
                    </span>
                @endif

            </div>

            <h3 class="text-xl font-semibold mb-2">
                <a href="{{ route('posts.show', $post->id) }}"
                   class="hover:text-green-700">
                    {{ $post->title }}
                </a>
            </h3>

            <p class="text-sm text-gray-500 mb-3">
                {{ $post->published_at?->format('M d, Y') }}
                | {{ $post->views }} views
            </p>

            <p class="text-gray-700 mb-3">
                {{ \Illuminate\Support\Str::limit($post->body, 160) }}
            </p>

            <a href="{{ route('posts.show', $post->id) }}"
               class="text-green-700 font-semibold">
                Read More
            </a>

        </article>

    @empty

        <p class="text-gray-600">
            No posts match your search.
        </p>

    @endforelse

</div>

<div class="mt-8 overflow-x-auto">
    {{ $posts->links() }}
</div>

<p class="mt-4 text-sm text-gray-500">
    Showing {{ $posts->firstItem() ?? 0 }}–{{ $posts->lastItem() ?? 0 }}
    of {{ $posts->total() }} posts
</p>

@endsection
