<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFileCsvRequest;
use App\Jobs\ImportStudentsCsv;
use App\Jobs\ImportTeachersCsv;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Import;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    public function importTeacher() {
        return Inertia::render('Admin/ImportTeacher');
    }

    public function storeTeacher(ImportFileCsvRequest $request) {
        // $file_name = basename($request->csv_import->getClientOriginalName(), '.'.$request->csv_import->getClientOriginalExtension());
        $file_name = date('Ymd_His_').$request->csv_import->getClientOriginalName();
        $file_path = storage_path('app\\data\\'.$file_name);

        $import = new Import();
        $import->name = $file_name;
        $import->path = $file_path;
        $import->status = 0;
        $import->created_by = Auth::user()->name;
        $import->save();
        
        // save file 
        $request->csv_import->move(storage_path('app\\data\\'), $file_name);

        $teacherImport = Import::latest()->first();
        $teacherImport = $import;
        $path = $file_path;

        ImportTeachersCsv::dispatch($path, $teacherImport)->delay(10);
        return response()->json('Tải file thành công, đang chờ xử lý');
    }

    public function importStudent() {
        return Inertia::render('Admin/ImportStudent');
    }

    public function storeStudent(ImportFileCsvRequest $request) {
        // $file_name = basename($request->csv_import->getClientOriginalName(), '.'.$request->csv_import->getClientOriginalExtension());
        $file_name = date('Ymd_His_').$request->csv_import->getClientOriginalName();
        $file_path = storage_path('app\\data\\'.$file_name);

        $import = new Import();
        $import->name = $file_name;
        $import->path = $file_path;
        $import->status = 0;
        $import->created_by = Auth::user()->name;
        $import->save();
        
        // save file 
        $request->csv_import->move(storage_path('app\\data\\'), $file_name);

        $studentImport = $import;
        $path = $file_path;

        ImportStudentsCsv::dispatch($path, $studentImport)->delay(10);
        return response()->json('Tải file thành công, đang chờ xử lý');
    }

    public function testImport()
    {
        $teacherImport = Import::latest()->first();
        $teacherImport = $teacherImport;
        $path = $teacherImport->path;
        // chmod($path, 0644);
        ImportTeachersCsv::dispatch($path, $teacherImport)->delay(10);
        return response()->json('Tải file thành công, đang chờ xử lý');
    }
}
