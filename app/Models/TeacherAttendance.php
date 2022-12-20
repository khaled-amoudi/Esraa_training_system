<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CurrentSemesterScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherAttendance extends BaseModel
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'period',
        'group_id',
        'semester_id',
        'date',
        'coming_time',
        'leaving_time'
    ];

    protected $columnsForSheets = [
        'teacher_id',
        'period',
        'group_id',
        'date',
        'coming_time',
        'leaving_time'
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function teacher(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

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
