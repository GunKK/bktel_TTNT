<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherToSubject extends Model
{
    use HasFactory;
    protected $table = 'teacher_to_subjects';
    public $fillable = [
        'teacher_id', 'subject_id', 'semester', 'year', 'note'
    ];

    public function teacher(): BelongsTo 
    {   
        return $this->belongsTo(Teacher::class);
    }

    public function subject(): BelongsTo 
    {   
        return $this->belongsTo(Subject::class);
    }

    // public function scopeWhereLike($query, $column, $value)
    // {
    //     return $query->where($column, 'like', '%'.$value.'%');
    // }

    // public function scopeOrWhereLike($query, $column, $value)
    // {
    //     return $query->orWhere($column, 'like', '%'.$value.'%');
    // }
}
