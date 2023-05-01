<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function index() 
    {
        $teachers = Subject::all();
        return response()->json($teachers);
    }

    public function create()
    {
        return Inertia::render('Subject/New');
    }

    public function store(SubjectRequest $request) 
    {
        $subject = new Subject($request->all());
        $subject->save();
        return response()->json($subject);
    }

}
