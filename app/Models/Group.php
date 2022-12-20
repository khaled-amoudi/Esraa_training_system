<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\CurrentSemesterScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'course_id',
        'user_id',
        'group_number',
        'attendance_days',
        'attendance_state',
        'grades_state',
        'semester_id',
    ];

    protected $columnsForSheets = [
        'name',
        'group_number',
        'course_id',
        'teacher_id',
        'attendance_days',
    ];



    public function scopeSearch(Builder $query, $request)
    {
        if ($request['name_groupNumber'] ?? false) {
            $query->where('name', 'LIKE', "%{$request['name_groupNumber']}%")->orWhere('group_number', 'LIKE', "%{$request['name_groupNumber']}%");
        }
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function teacher(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students(){
        return $this->belongsToMany(Student::class, 'group_student');
    }

    public function student_attendances()
    {
        return $this->belongsToMany(StudentAttendance::class);
    }
    public function student_grades()
    {
        return $this->hasMany(StudentGrade::class);
    }

    protected function attendanceState(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value == 'on' ? 1 : 0,
        );
    }
    protected function gradesState(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value == 'on' ? 1 : 0,
        );
    }
    // public function groupAttendanceDay(){
    //     return $this->belongsTo(GroupAttendanceDay::class);
    // }


        /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new CurrentSemesterScope);
    }
}
