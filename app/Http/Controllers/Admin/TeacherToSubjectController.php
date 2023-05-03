<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\TeacherToSubjectsRequest;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherToSubject;

class TeacherToSubjectController extends Controller
{
    public function index() 
    {
        
    }

    public function create() 
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return Inertia::render('TeacherToSubjects/New', [
            'teachers' => $teachers,
            'subjects' => $subjects
        ]);
    }

    public function store(TeacherToSubjectsRequest $request) 
    {
        // dd($request->all());
        $teacherToSubject = new TeacherToSubject($request->all());
        $teacherToSubject->save();
        return response()->json($teacherToSubject);
    }
}
