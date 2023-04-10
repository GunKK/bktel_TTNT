<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImportController extends Controller
{
    public function import_teacher() {
        return Inertia::render('Admin/ImportTeacher');
    }

    public function store_teacher(Request $request) {
        dd($request->all());
    }
}
