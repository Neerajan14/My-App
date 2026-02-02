@extends('layouts.app') <!-- Use your main layout -->

@section('content')

<h2>Create New Student</h2>

<!-- Display validation errors -->
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Display success message -->
@if (session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name') }}" required /><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required /><br>

    <label>Roll Number:</label>
    <input type="text" name="roll_number" value="{{ old('roll_number') }}" required /><br>

    <label>Class:</label>
    <input type="text" name="class" value="{{ old('class') }}" required /><br>

    <label>Marks:</label>
    <input type="number" name="marks" value="{{ old('marks') }}" required /><br>

    <button type="submit">Add Student</button>
</form>

<hr>



@endsection
