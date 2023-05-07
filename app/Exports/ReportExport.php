<?php

namespace App\Exports;

use App\Models\TeacherToSubject;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $year;
    public $semester;
    public $teacherId;
    public $subjectId;

    public function __construct($year=null,$semester=null,$teacherId=null,$subjectId=null)
    {
        $this->year = $year;
        $this->semester = $semester;
        $this->teacherId = $teacherId;
        $this->subjectId = $subjectId;
    }

    public function query()
    {
        $query = TeacherToSubject::query();
        $query = $query->select('year', 'semester', 'teachers.id AS teacher_id', 'teachers.last_name AS tea_lname',
                                'teachers.first_name AS tea_fname' , 'subjects.id AS subject_id', 'subjects.name AS subject_name', 
                                'student_id', 'students.last_name AS stu_lname', 'students.first_name AS stu_fname', 'reports.path', 'mark')
                        ->join('reports', 'teacher_to_subjects.id', '=', 'reports.teacher_to_subjects_id')
                        ->join('subjects', 'subjects.id', '=', 'teacher_to_subjects.subject_id')
                        ->join('teachers','teacher_id', '=', 'teachers.id')
                        ->join('students', 'student_id', '=', 'students.id');
        if (isset($this->year)) 
        {
            $query->where('year', '=', $this->year);
        }

        if (isset($this->semester)) 
        {
            $query->where('semester', '=', $this->semester);
        }

        if (isset($this->teacherId)) 
        {
            $query->where('teacher_id', '=', $this->teacherId);
        }

        if (isset($this->subjectId)) 
        {
            $query->where('subjects.id', '=', $this->subjectId);
        }

        $query->get();

        return $query;
    }

    public function headings():array
    {
        return [
            'Year',
            'Semester',
            'teacherId',
            'TeacherName',
            'SubjectId',
            'SubjectName',
            'StudentId',
            'StudentName',
            'SubmitOrNot',
            'Mark'
        ];
    } 

    public function map($row): array
    {
        return [
            $row->year,
            $row->semester,
            $row->teacher_id,
            $row->tea_lname . $row->tea_fname,
            $row->subject_id,
            $row->subject_name,
            $row->student_id,
            $row->stu_lname . $row->stu_fname,
            $row->path != '' ? true : false,
            $row->mark
        ];
    }
}
