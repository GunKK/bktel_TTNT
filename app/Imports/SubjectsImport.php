<?php

namespace App\Imports;

use App\Models\Subject;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SubjectsImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row ) {
            $subject = new Subject();
            $subject->name = $row[0];
            $subject->code = $row[1];
            $subject->note = $row[2];
            $subject->save();
        }
    }
}
