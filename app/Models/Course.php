<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends BaseModel
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'course_number',
        'semester_id',
        'degree',
    ];

    protected $columnsForSheets = [
        'name',
        'course_number',
        'degree',
    ];


    public function scopeSearch(Builder $query, $request)
    {
        if ($request['name_courseNumber'] ?? false) {
            $query->where('name', 'LIKE', "%{$request['name_courseNumber']}%")->orWhere('course_number', 'LIKE', "%{$request['name_courseNumber']}%");
        }
        if (isset($request['degree']) && $request['degree'] != '') {
            $query->where('degree', '=', $request['degree']);
        }
    }

    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }
}
