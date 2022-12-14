<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $table = 'student_attendances';
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'course_id',
        'group_id',
        'attendance',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
