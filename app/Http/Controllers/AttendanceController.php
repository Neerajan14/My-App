<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $date = $request->input('date');
        
        $query = Attendance::with('student');
        
        if ($search) {
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('roll_number', 'like', '%' . $search . '%');
            });
        }
        
        if ($date) {
            $query->whereDate('date', $date);
        }
        
        $attendances = $query->orderBy('date', 'desc')->paginate(15);
        return view('attendance.index', compact('attendances', 'search', 'date'));
    }

    public function create()
    {
        $students = Student::all();
        return view('attendance.create', compact('students'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late,leave',
            'remarks' => 'nullable|string|max:500',
        ]);

        try {
            Attendance::create($data);
            return redirect()->route('attendance.index')->with('success', 'Attendance marked successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Duplicate entry for this student on this date.');
        }
    }

    public function edit(Attendance $attendance)
    {
        $students = Student::all();
        return view('attendance.edit', compact('attendance', 'students'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late,leave',
            'remarks' => 'nullable|string|max:500',
        ]);

        try {
            $attendance->update($data);
            return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to update attendance.');
        }
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Attendance record deleted.');
    }

    public function bulkCreate()
    {
        $students = Student::all();
        return view('attendance.bulk-create', compact('students'));
    }

    public function bulkStore(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*' => 'required|in:present,absent,late,leave',
        ]);

        $date = $data['date'];
        $created = 0;
        $updated = 0;

        foreach ($data['attendances'] as $studentId => $status) {
            $record = Attendance::updateOrCreate(
                ['student_id' => $studentId, 'date' => $date],
                ['status' => $status]
            );

            if ($record->wasRecentlyCreated) {
                $created++;
            } else {
                $updated++;
            }
        }

        return redirect()->route('attendance.index')
                       ->with('success', "Attendance marked for $created students (Updated: $updated).");
    }
}
