<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Show all students (index page)
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        $students = Student::all(); // If you want to show table on create page
        return view('students.create', compact('students'));
    }

    // Store new student
    public function store(Request $request)
{
    // validation & create student
    Student::create($request->all());

    // Redirect to students list instead of create page
    return redirect()->route('students.index')->with('success', 'Student added successfully!');
}


    // Show edit form
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);
    $student->update($request->all());

    // Redirect to list page
    return redirect()->route('students.index')->with('success', 'Student updated successfully!');
}


    // Delete student
    public function destroy($id)
{
    $student = Student::findOrFail($id);
    $student->delete();

    // Redirect to list page
    return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
}

}

