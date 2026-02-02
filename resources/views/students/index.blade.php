@extends('layouts.app')

@section('content')

<h2>Students List</h2>

@if($students->count())
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roll Number</th>
            <th>Class</th>
            <th>Marks</th>
            <th>Actions</th>
        </tr>

        @foreach($students as $student)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->roll_number }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->marks }}</td>
                <td>
                    <!-- Edit link -->
                    <a href="{{ route('students.edit', $student->id) }}">Edit</a>

                    <!-- Delete form -->
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@else
    <p>No students found.</p>
@endif

@endsection
