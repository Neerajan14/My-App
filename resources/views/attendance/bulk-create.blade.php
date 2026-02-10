@extends('layouts.app')

@section('title', 'Bulk Mark Attendance')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-semibold mb-4">Bulk Mark Attendance</h1>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attendance.bulk-store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Date</label>
            <input type="date" name="date" value="{{ old('date', today()) }}" class="w-full border rounded p-2" required>
            @error('date') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="overflow-x-auto mb-6">
            <table class="w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3 text-left">Student Name</th>
                        <th class="border p-3 text-left">Roll Number</th>
                        <th class="border p-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-3">{{ $student->name }}</td>
                            <td class="border p-3">{{ $student->roll_number }}</td>
                            <td class="border p-3">
                                <select name="attendances[{{ $student->id }}]" class="border rounded p-2" required>
                                    <option value="">Select...</option>
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                    <option value="late">Late</option>
                                    <option value="leave">Leave</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center space-x-2">
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Save Attendance</button>
            <a href="{{ route('attendance.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
