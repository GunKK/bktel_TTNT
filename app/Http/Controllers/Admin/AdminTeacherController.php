<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminTeacherController extends Controller
{
    public function index() {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }

    public function create()
    {
        return Inertia::render('Teacher/New');
    }

    public function store(TeacherRequest $request) {
        $data = $request->all();
        // dd($data);
        $teacher = new Teacher();
        $teacher->last_name = $data['last_name'];
        $teacher->first_name = $data['first_name'];
        $teacher->teacher_code = $data['teacher_code'];
        $teacher->department = $data['department'];
        $teacher->faculty = $data['faculty'];
        $teacher->address = $data['address'];
        $teacher->phone = $data['phone'];
        $teacher->note = $data['note'];
        $teacher->save();

        $user = new User();
        $user->name = $data['last_name']." ".$data['first_name'];
        $user->email = $data['email'];
        $user->password = Hash::make('Bmvt@hcmut');
        $user->role_id = 3;
        $user->teacher_id = $teacher->id;
        $user->save();

        return response()->json($teacher);
    }
}
