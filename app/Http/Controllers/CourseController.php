<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Room;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $rooms = Room::all();
       
        return view('courses.index', compact('courses','rooms'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('courses.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'room_id' => 'required|exists:rooms,id',
        ]);

        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $rooms = Room::all();
        return view('courses.edit', compact('course', 'rooms'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}