<?php

namespace App\Imports;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TeachersImport implements ToCollection, WithStartRow
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
            $teacher = new Teacher();
            $teacher->last_name = $row[0];
            $teacher->first_name = $row[1];
            $teacher->teacher_code = $row[3];
            $teacher->department = $row[5];
            $teacher->faculty = $row[4];
            $teacher->address = $row[6];
            $teacher->phone = $row[7];
            $teacher->note = $row[8];
            $teacher->save();

            $user = new User();
            $user->name = $row[0]." ".$row[1];
            $user->email = $row[2];
            $user->password = Hash::make("Bmvt@hcmut");
            $user->role_id = 3;
            $user->teacher_id = $teacher->id;
            $user->save();
        }
    }
}
