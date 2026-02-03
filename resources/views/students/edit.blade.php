@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

<h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Student</h2>

@if ($errors->any())
<div class="mb-4 rounded bg-red-100 p-4 text-red-700">
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

    <label class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
    <input type="text" name="name" value="{{ old('name', $student->name) }}"
    class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-200"><br><br>

    <label class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
    <input type="email" name="email" value="{{ old('email', $student->email) }}" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-200"><br><br>

    <label class="block text-sm font-medium text-gray-700 mb-1">Roll Number:</label>
    <input type="text" name="roll_number" value="{{ old('roll_number', $student->roll_number) }}" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-200"><br><br>
    <label class="block text-sm font-medium text-gray-700 mb-1">Class:</label>
    <input type="text" name="class" value="{{ old('class', $student->class) }}" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-200"><br><br>

    <label class="block text-sm font-medium text-gray-700 mb-1">Marks:</label>
    <input type="text" name="marks" value="{{ old('marks', $student->marks) }}" class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-200"><br><br>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">Update Student</button>
</form>

<a href="{{ route('students.index') }}" class="text-blue-600 hover:underline">Back to Student List</a>

@endsection
