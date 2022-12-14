<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Year extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'year',
    ];

    protected $columnsForSheets = [
        'year'
    ];


    public function scopeSearch(Builder $query, $request)
    {
        if ($request['name'] ?? false) {
            $query->where('name', 'LIKE', "%{$request['name']}%");
        }
    }



    public function semesters(){
        return $this->hasMany(Semester::class);
    }
}
