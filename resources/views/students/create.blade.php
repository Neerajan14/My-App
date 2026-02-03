@extends('layouts.app') <!-- Use your main layout -->

@section('content')
<div class="max-w-xl mx-auto my-10 bg-white p-6 rounded-lg shadow-lg">

<h2 class="text-2xl font-bold mb-6 text-gray-800">Create New Student</h2>

<!-- Display validation errors -->
@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
        <ul class ="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Display success message -->
@if (session('success'))
    <div class="mb-4 rounded bg-green-100 p-4 text-green-700">
    </div>
@endif

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <label class="block text-sm font-medium text-gray-700">Name:</label>
    <input type="text" name="name" value="{{ old('name') }}" 
    required class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" /><br>

    <label class="block text-sm font-medium text-gray-700">Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" 
    required class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"/><br>

    <label class="block text-sm font-medium text-gray-700">Roll Number:</label>
    <input type="text" name="roll_number" value="{{ old('roll_number') }}" 
    required class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" /><br>

    <label class="block text-sm font-medium text-gray-700">Class:</label>
    <input type="text" name="class" value="{{ old('class') }}" required class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"/><br>

    <label class="block text-sm font-medium text-gray-700">Marks:</label>
    <input type="number" name="marks" value="{{ old('marks') }}" required class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" /><br>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">Add Student</button>
</form>

<hr>



@endsection
