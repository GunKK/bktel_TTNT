<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;


class StudentsImport implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row ) {
            $student = new Student();
            $student->last_name = $row[0];
            $student->first_name = $row[1];
            $student->student_code = $row[3];
            $student->department = $row[5];
            $student->faculty = $row[4];
            $student->address = $row[6];
            $student->phone = $row[7];
            $student->note = $row[8];
            $student->save();

            $user = new User();
            $user->name = $row[0]." ".$row[1];
            $user->email = $row[2];
            $user->password = $row[9];
            $user->role_id = 4;
            $user->student_id = $student->id;
            $user->save();
        }
    }
}
