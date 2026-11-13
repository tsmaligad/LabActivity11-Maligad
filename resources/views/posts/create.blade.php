@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('posts.index') }}"
       class="text-green-700 font-semibold">
        ← Back to Bulletin
    </a>

    <div class="bg-white rounded-xl shadow p-6 mt-5">
        <h2 class="text-2xl font-bold mb-6">
            Create New Post
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                <p class="font-semibold mb-2">Please fix the following:</p>
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label for="title" class="block font-semibold mb-2">
                    Post Title
                </label>

                <input type="text" id="title" name="title"
                       value="{{ old('title') }}"
                       class="w-full border rounded-lg px-3 py-2">

                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="body" class="block font-semibold mb-2">
                    Post Content
                </label>

                <textarea id="body" name="body" rows="6"
                          class="w-full border rounded-lg px-3 py-2">{{ old('body') }}</textarea>

                @error('body')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="category" class="block font-semibold mb-2">
                    Category
                </label>

                <select id="category" name="category"
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="">Select category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category }}"
                            @selected(old('category') == $category)>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                @error('category')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <fieldset class="mb-5">
                <legend class="block font-semibold mb-2">
                    Tags
                </legend>

                <div class="flex flex-wrap gap-4">
                    @foreach ($tags as $tag)
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                   name="tags[]"
                                   value="{{ $tag->id }}"
                                   @checked(in_array($tag->id, old('tags', [])))>
                            <span>{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>

                @error('tags')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                @foreach ($errors->get('tags.*') as $message)
                    <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                    </p>
                @endforeach

            </fieldset>

            <div class="mb-6">
                <input type="hidden" name="is_published" value="0">

                <label class="flex items-center gap-2">
                    <input type="checkbox"
                           name="is_published"
                           value="1"
                           @checked(old('is_published', '1') == '1')>
                    <span class="font-medium">Publish immediately</span>
                </label>

                @error('is_published')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg font-semibold">
                Save Post
            </button>
        </form>
    </div>
</div>
@endsection
