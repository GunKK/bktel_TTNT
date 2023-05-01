<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $students = Student::all();

    //     return response()->json($students);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Student/New');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {   
        dd($request->all());
        $data = $request->all();
        // dd($data);
        $student = new Student($data);
        $student->save();
        // dd($student->id);

        $user = $request->user();
        $user->student_id = $student->id;
        $user->save();

        return response()->json($student);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);

        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);

        // return response()->json($student);
        return Inertia::render('Student/Update', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $student = Student::find($id);
        $student->update($data);

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();
        // $userStudent = User::where('student_id', $id);
        // $userStudent->update(['student_id' => null]);

        return response('message', 'Đã xóa thành công');
    }
}
