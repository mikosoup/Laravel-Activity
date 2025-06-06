<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Students::all();
        return view('students-list', compact('students'));
    }
}
