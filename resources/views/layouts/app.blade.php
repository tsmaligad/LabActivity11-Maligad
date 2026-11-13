<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Bulletin – Purok Maligad</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    <main class="max-w-5xl mx-auto px-4 py-8">
        @yield('content')
    </main>

</body>
</html>
