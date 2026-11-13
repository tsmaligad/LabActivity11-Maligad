
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Bulletin – Purok Maligad</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-slate-100 min-h-screen text-slate-800">

    <header class="bg-green-800 text-white py-6">
        <div class="max-w-5xl mx-auto px-4">
            <h1 class="text-2xl font-bold">
                Barangay Bulletin – Purok Maligad
            </h1>
            <p class="text-sm mt-1">
                Barangay Matina Crossing, Davao City
            </p>
        </div>
    </header>

    <nav class="bg-white border-b shadow-sm">
        <div class="max-w-5xl mx-auto px-4 py-4 flex flex-wrap justify-between items-center gap-4">

            <a href="{{ route('posts.index') }}"
               class="text-green-800 font-semibold">
                Home
            </a>

            <div class="flex items-center gap-4">
                @auth
                    <span class="text-sm text-gray-600">
                        Hi, {{ auth()->user()->name }}
                    </span>
                    
                    @if (auth()->user()->author()->exists())
                       <a href="{{ route('posts.create') }}"
                        class="bg-green-700 text-white px-4 py-2 rounded-lg font-semibold">
                          New Post
                       </a>
                     @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit"
                                class="text-red-600 font-semibold">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="text-green-700 font-semibold">
                        Sign In
                    </a>
                @endauth
            </div>

        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-8">
        @yield('content')
    </main>

</body>
</html>
