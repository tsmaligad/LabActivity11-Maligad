@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-6">Sign In</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-2">Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded-lg p-3"
                required
            >

            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label class="block font-medium mb-2">Password</label>

            <input
                type="password"
                name="password"
                class="w-full border rounded-lg p-3"
                required
            >

            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full bg-green-700 hover:bg-green-800 text-white py-3 rounded-lg font-semibold"
        >
            Sign In
        </button>
    </form>
</div>
@endsection
