@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <div class="flex items-center justify-between mb-6">

    

<h2 class="text-2xl font-bold text-gray-800">Students List</h2>

    <a href="{{ route('students.create') }}" 
    class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">Add New Student</a>

@if($students->count())
<div class="overflow-x-auto">
    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Roll Number</th>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Class</th>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Marks</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody class="divide-y">

        @foreach($students as $student)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2">{{ $loop->iteration}}</td>
                <td class="px-4 py-2">{{ $student->name }}</td>
                <td class="px-4 py-2">{{ $student->email }}</td>
                <td class="px-4 py-2">{{ $student->roll_number }}</td>
                <td class="px-4 py-2">{{ $student->class }}</td>
                <td class="px-4 py-2">{{ $student->marks }}</td>
                <td>
                    <!-- Edit link -->
                    <a href="{{ route('students.edit', $student->id) }}" class="text-blue-600 hover:underline">Edit</a>

                    <!-- Delete form -->
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>No students found.</p>
@endif

@endsection