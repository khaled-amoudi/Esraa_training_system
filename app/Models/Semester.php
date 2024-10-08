<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year_id',
        'is_current_semester'
    ];



    public function scopeCurrentSemester($query){
        $query->where('is_current_semester', 1)->first();
    }


    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }
}
