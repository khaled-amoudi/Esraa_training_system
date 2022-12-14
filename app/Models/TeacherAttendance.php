<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'user_id',
        'period',
        'group_id',
        'semester_id',
        'date',
        'coming_time',
        'leaving_time'
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }
}
