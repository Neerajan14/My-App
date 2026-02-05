@extends('layouts.app')

@section('title', 'Teachers Report')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Teachers Report</h1>
        <div>
            <a href="{{ route('teachers.index') }}" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">Back to list</a>
        </div>
    </div>

    <form method="GET" action="{{ route('teachers.report') }}" class="mb-4 flex items-end space-x-2">
        <div>
            <label class="block text-sm text-gray-700 mb-1">Subject</label>
            <select name="subject" class="border rounded p-2">
                <option value="">-- All --</option>
                @foreach($subjects as $s)
                    <option value="{{ $s }}" {{ request('subject') === $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Filter</button>
        </div>

        <div>
            <a href="{{ route('teachers.export', request()->only('subject')) }}" class="bg-green-600 text-white px-3 py-1 rounded">Export CSV</a>
        </div>
    </form>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Subject</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Registered</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $t)
                    <tr class="border-t">
                        <td class="p-3">{{ $t->name }}</td>
                        <td class="p-3">{{ $t->email }}</td>
                        <td class="p-3">{{ $t->subject }}</td>
                        <td class="p-3">{{ $t->phone }}</td>
                        <td class="p-3">{{ $t->created_at->toDateString() }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-3">No teachers match the filter.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
