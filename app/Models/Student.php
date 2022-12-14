<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'university_number',
        'college',
    ];

    protected $columnsForSheets = [
        'name',
        'university_number',
        'college',
    ];


    public function scopeSearch(Builder $query, $request)
    {
        if ($request['name_university_number'] ?? false) {
            $query->where('name', 'LIKE', "%{$request['name_university_number']}%")->orWhere('university_number', 'LIKE', "%{$request['name_university_number']}%");
        }
        if (isset($request['college']) && $request['college'] != '') {
            $query->where('college', '=', $request['college']);
        }
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'group_student');
    }
    public function studentAttendance(){
        return $this->hasMany(StudentAttendance::class);
    }
}
