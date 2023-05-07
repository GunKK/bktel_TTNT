<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function create() 
    {
        return Inertia::render('Admin/ExportMark', [
            'teachers' => Teacher::all(),
            'subjects' => Subject::all()
        ]);
    }

    public function exportMark(Request $request)
    {
        // dd($request->all());
        return Excel::download(
            new ReportExport($request->year,
                             $request->semester, 
                             $request->teacherId, 
                             $request->subjectId), 
            'mark.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
