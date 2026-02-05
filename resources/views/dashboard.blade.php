@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Students</h2>
            <p class="text-3xl font-bold mt-2">{{ $students ?? 0 }}</p>
            <a href="{{ route('students.index') }}" class="text-sm text-blue-600 mt-2 inline-block">View students</a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Teachers</h2>
            <p class="text-3xl font-bold mt-2">{{ $teachers ?? 0 }}</p>
            <a href="{{ route('teachers.index') }}" class="text-sm text-blue-600 mt-2 inline-block">View teachers</a>
        </div>
    </div>
</div>
@endsection
