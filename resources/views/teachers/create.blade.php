@extends('layouts.app')

@section('title', 'Register Teacher')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-semibold mb-4">Register Teacher</h1>

    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
            @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2" required>
            @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Subject</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="w-full border rounded p-2">
            @error('subject') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded p-2">
            @error('phone') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="flex items-center space-x-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('teachers.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
