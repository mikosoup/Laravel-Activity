<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::all(); 
        return view('students.index', compact('students'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'stdName' => 'required|string|max:255',
            'stdAge' => 'required|integer|min:1|max:120'
        ]);

        Student::create([
            'name' => $request->stdName,
            'age' => $request->stdAge
        ]);

        return redirect()->route('students.index')
                        ->with('success', 'Student added successfully!');
}

    public function create()
    {
        return view('students.create');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Show edit form
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'stdName' => 'required|string|max:255',
            'stdAge' => 'required|integer|min:1|max:120'
        ]);

        $student->update([
            'name' => $request->stdName,
            'age' => $request->stdAge
        ]);

        return redirect()->route('students.index')
                        ->with('success', 'Student updated successfully!');
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();
        
        return redirect()->route('students.index')
                        ->with('success', 'Student deleted successfully!');
    }
}