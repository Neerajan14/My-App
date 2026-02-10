@extends('layouts.app')

@section('title', 'Edit Attendance')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-semibold mb-4">Edit Attendance</h1>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attendance.update', $attendance) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Student</label>
            <select name="student_id" class="w-full border rounded p-2" required>
                <option value="">Select a student...</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $attendance->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->name }} ({{ $student->roll_number }})
                    </option>
                @endforeach
            </select>
            @error('student_id') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Date</label>
            <input type="date" name="date" value="{{ old('date', $attendance->date->format('Y-m-d')) }}" class="w-full border rounded p-2" required>
            @error('date') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full border rounded p-2" required>
                <option value="">Select status...</option>
                <option value="present" {{ old('status', $attendance->status) === 'present' ? 'selected' : '' }}>Present</option>
                <option value="absent" {{ old('status', $attendance->status) === 'absent' ? 'selected' : '' }}>Absent</option>
                <option value="late" {{ old('status', $attendance->status) === 'late' ? 'selected' : '' }}>Late</option>
                <option value="leave" {{ old('status', $attendance->status) === 'leave' ? 'selected' : '' }}>Leave</option>
            </select>
            @error('status') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Remarks</label>
            <textarea name="remarks" class="w-full border rounded p-2" rows="3">{{ old('remarks', $attendance->remarks) }}</textarea>
            @error('remarks') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="flex items-center space-x-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('attendance.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
