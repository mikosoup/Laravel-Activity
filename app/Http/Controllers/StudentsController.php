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
}