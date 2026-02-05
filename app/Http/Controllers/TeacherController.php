<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('created_at', 'desc')->paginate(15);
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'subject' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Teacher::create($data);

        return redirect()->route('teachers.index')->with('success', 'Teacher registered successfully.');
    }

    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'subject' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $teacher->update($data);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted.');
    }

    public function report(Request $request)
    {
        $query = Teacher::query();

        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        $teachers = $query->get();
        $subjects = Teacher::select('subject')->distinct()->pluck('subject')->filter()->values();

        return view('teachers.report', compact('teachers', 'subjects'));
    }

    public function export(Request $request)
    {
        $query = Teacher::query();

        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        $teachers = $query->get();

        $filename = 'teachers_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($teachers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Name', 'Email', 'Subject', 'Phone', 'Created At']);

            foreach ($teachers as $t) {
                fputcsv($file, [$t->name, $t->email, $t->subject, $t->phone, $t->created_at->toDateTimeString()]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
