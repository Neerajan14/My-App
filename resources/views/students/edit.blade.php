@extends('layouts.app')
@section('content')

<h2>Edit Student</h2>

@if ($errors->any())
<div style="color: red">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name', $student->name) }}"><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $student->email) }}"><br><br>

    <label>Roll Number:</label>
    <input type="text" name="roll_number" value="{{ old('roll_number', $student->roll_number) }}"><br><br>

    <label>Class:</label>
    <input type="text" name="class" value="{{ old('class', $student->class) }}"><br><br>

    <label>Marks:</label>
    <input type="text" name="marks" value="{{ old('marks', $student->marks) }}"><br><br>

    <button type="submit">Update Student</button>
</form>

<a href="{{ route('students.index') }}">Back to Student List</a>

@endsection
