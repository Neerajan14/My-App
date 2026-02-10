@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Attendance</h1>
        <div class="space-x-2">
            <a href="{{ route('attendance.bulk-create') }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Bulk Mark</a>
            <a href="{{ route('attendance.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Mark Attendance</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <div class="mb-6">
        <form action="{{ route('attendance.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" placeholder="Search by student name or roll number..." 
                   value="{{ $search }}" class="flex-1 border border-gray-300 rounded px-4 py-2">
            <input type="date" name="date" value="{{ $date }}" class="border border-gray-300 rounded px-4 py-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
            @if($search || $date)
                <a href="{{ route('attendance.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Clear</a>
            @endif
        </form>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3">Student Name</th>
                    <th class="p-3">Roll Number</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Remarks</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $record)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $record->student->name }}</td>
                        <td class="p-3">{{ $record->student->roll_number }}</td>
                        <td class="p-3">{{ $record->date->format('M d, Y') }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm font-semibold
                                @if($record->status === 'present') bg-green-100 text-green-800
                                @elseif($record->status === 'absent') bg-red-100 text-red-800
                                @elseif($record->status === 'late') bg-yellow-100 text-yellow-800
                                @else bg-blue-100 text-blue-800
                                @endif">
                                {{ ucfirst($record->status) }}
                            </span>
                        </td>
                        <td class="p-3 text-sm">{{ $record->remarks ?? '-' }}</td>
                        <td class="p-3 space-x-2">
                            <a href="{{ route('attendance.edit', $record) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('attendance.destroy', $record) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-3 text-center">No attendance records found.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">{{ $attendances->links() }}</div>
    </div>
</div>
@endsection
