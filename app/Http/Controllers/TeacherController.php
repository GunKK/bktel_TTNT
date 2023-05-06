<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->q;
        $teacherId = Auth::user()->teacher_id;
        $result = Report::select('teacher_to_subjects.id','last_name', 'first_name', 'name', 'code', 'year', 'semester', 'title', 'path')
            ->join('teacher_to_subjects', 'teacher_to_subjects.id', '=', 'teacher_to_subjects_id')
            ->join('students', 'students.id','=','reports.student_id')
            ->join('subjects', 'subjects.id','=','teacher_to_subjects.subject_id')
            ->where('teacher_id', '=', $teacherId)
            ->where('last_name', 'like', '%' . $q . '%')
            ->orWhere('first_name', 'like', '%' . $q . '%')
            ->orWhere('name', 'like', '%' . $q . '%')
            ->orWhere('code', 'like', '%' . $q . '%')
            ->get();

        return response()->json($result);
    }

    public function setMark() 
    {
        
    }
}
