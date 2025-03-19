<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = User::all();
        $professors = User::where('role', 'professor')->get(); 
        $attendances = Attendance::all();
        $courses = Course::all();
        return view('attendances.index', compact('attendances','professors','courses'));
    }

    public function create()
    {
        $courses = Course::all();
        $professors = User::where('role', 'professor')->get();
        return view('attendances.create', compact('courses', 'professors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'status' => 'required',
            'professor_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        Attendance::create($validated);
        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
    }

    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $courses = Course::all();
        $professors = User::where('role', 'professor')->get();
        return view('attendances.edit', compact('attendance', 'courses', 'professors'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'status' => 'required',
            'professor_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $attendance->update($validated);
        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
}