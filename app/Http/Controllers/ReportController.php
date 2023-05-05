<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportFileRequest;
use App\Models\Report;
use App\Models\TeacherToSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    public function store(ReportFileRequest $request) 
    {
        // dd($request->all());
        $teacherToSubject = TeacherToSubject::find($request->teacher_to_subjects_id);
        $year = $teacherToSubject->year;
        $semester = $teacherToSubject->semester;
        $file_name = date('Ymd_His_').$request->file->getClientOriginalName();
        $file_path = storage_path('app\\data\\reports\\'.$year.'\\'.$semester.'\\'.$teacherToSubject->id.'\\'.$file_name);

        $report = new Report();
        $report->student_id = Auth::user()->student_id;
        $report->teacher_to_subjects_id = $request->teacher_to_subjects_id;
        $report->title = $request->title;
        $report->path = $file_path;
        $report->save();

        $request->file->move(storage_path('app\\data\\reports\\'.$year.'\\'.$semester.'\\'.$teacherToSubject->id), $file_name);

        return response()->json('Upload file thành công');
    }

    public function search(Request $request) 
    {
        // dd($request->all());
        $q = $request->q;
        $result = TeacherToSubject::select('teacher_to_subjects.id','last_name', 'first_name', 'name', 'code', 'year', 'semester')
            ->join('teachers', 'teachers.id','=','teacher_to_subjects.teacher_id')
            ->join('subjects', 'subjects.id','=','teacher_to_subjects.subject_id')
            ->where('last_name', 'like', '%' . $q . '%')
            ->orWhere('first_name', 'like', '%' . $q . '%')
            ->orWhere('name', 'like', '%' . $q . '%')
            ->orWhere('code', 'like', '%' . $q . '%')
            ->get();
        
        return response()->json($result);
    }
}
