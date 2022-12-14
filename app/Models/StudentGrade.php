<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $table = 'student_grades';
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'course_id',
        'group_id',
        'semester_id',
        'grades',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
