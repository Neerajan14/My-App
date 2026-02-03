<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management App</title>

    <!-- Tailwind via Vite (Laravel recommended) -->
    @vite('resources/js/app.js')

    <!-- Quick CDN alternative (for testing) -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet"> -->
</head>
<body class="bg-gray-100 font-sans min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4 mb-6">
        <div class="container mx-auto flex space-x-4">
            <a href="{{ route('students.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Home</a>
            <a href="{{ route('students.create') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Create Student</a>
        </div>
    </nav>

    <!-- Success Message -->
    @if (session('success'))
        <div class="container mx-auto mb-4">
            <p class="bg-green-100 text-green-700 p-3 rounded shadow">
                {{ session('success') }}
            </p>
        </div>
    @endif

    <!-- Main Content -->
    <div class="container mx-auto px-4">
        @yield('content')
    </div>

</body>
</html>
