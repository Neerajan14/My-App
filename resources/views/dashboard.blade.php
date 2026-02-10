@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Students</h2>
            <p class="text-3xl font-bold mt-2 text-blue-600">{{ $students ?? 0 }}</p>
            <a href="{{ route('students.index') }}" class="text-sm text-blue-600 mt-2 inline-block hover:underline">View students →</a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Teachers</h2>
            <p class="text-3xl font-bold mt-2 text-green-600">{{ $teachers ?? 0 }}</p>
            <a href="{{ route('teachers.index') }}" class="text-sm text-blue-600 mt-2 inline-block hover:underline">View teachers →</a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Total Attendance</h2>
            <p class="text-3xl font-bold mt-2 text-purple-600">{{ $totalAttendance ?? 0 }}</p>
            <a href="{{ route('attendance.index') }}" class="text-sm text-blue-600 mt-2 inline-block hover:underline">View attendance →</a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Today's Attendance</h2>
            <p class="text-3xl font-bold mt-2 text-indigo-600">{{ $todayAttendance ?? 0 }}</p>
            <a href="{{ route('attendance.index', ['date' => today()]) }}" class="text-sm text-blue-600 mt-2 inline-block hover:underline">View today →</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">Today's Status</h2>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Present</span>
                    <span class="text-2xl font-bold text-green-600">{{ $presentToday ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Absent</span>
                    <span class="text-2xl font-bold text-red-600">{{ $absentToday ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center border-t pt-3">
                    <span class="text-gray-600 font-semibold">Total Marked</span>
                    <span class="text-2xl font-bold text-blue-600">{{ ($presentToday ?? 0) + ($absentToday ?? 0) }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">Quick Actions</h2>
            <div class="space-y-2">
                <a href="{{ route('students.create') }}" class="block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-center">+ Add Student</a>
                <a href="{{ route('teachers.create') }}" class="block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-center">+ Register Teacher</a>
                <a href="{{ route('attendance.bulk-create') }}" class="block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 text-center">📋 Mark Attendance</a>
            </div>
        </div>
    </div>
</div>
@endsection
