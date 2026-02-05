@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Teachers</h1>
        <div class="space-x-2">
            <a href="{{ route('teachers.report') }}" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">Reports</a>
            <a href="{{ route('teachers.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Register Teacher</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Subject</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr class="border-t">
                        <td class="p-3">{{ $teacher->name }}</td>
                        <td class="p-3">{{ $teacher->email }}</td>
                        <td class="p-3">{{ $teacher->subject }}</td>
                        <td class="p-3">{{ $teacher->phone }}</td>
                        <td class="p-3">
                            <a href="{{ route('teachers.edit', $teacher) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this teacher?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-3">No teachers found.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">{{ $teachers->links() }}</div>
    </div>
</div>
@endsection
