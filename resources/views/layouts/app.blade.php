<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg flex-shrink-0 hidden md:block">
        <div class="p-6 font-bold text-xl border-b">MyApp</div>
        <nav class="p-6 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('dashboard') ? 'bg-gray-200' : '' }}">Dashboard</a>
            <a href="{{ route('students.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('students*') ? 'bg-gray-200' : '' }}">Students</a>
            <a href="{{ route('teachers.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('teachers*') ? 'bg-gray-200' : '' }}">Teachers</a>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">
        <!-- Top Navbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="text-lg font-semibold">@yield('title', 'Dashboard')</div>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-700">Hello, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
                @endauth
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6 overflow-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>
