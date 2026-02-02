<!DOCTYPE html>
<html>
    <head>
        <title>Student Management App</title>
    </head>
    <body>

    <nav>
        <a href="{{ route('students.index') }}">Home</a>
        <a href="{{ route('students.create') }}">Create Student</a>
        
    </nav>

    <hr>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @yield('content')
    
    </body>
</html>