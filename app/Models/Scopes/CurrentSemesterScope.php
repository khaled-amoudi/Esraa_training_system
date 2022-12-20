<?php

namespace App\Models\Scopes;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CurrentSemesterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $semester_id_exists = Semester::where('is_current_semester', '1')->exists();
        if($semester_id_exists){
            $semester_id = optional(Semester::where('is_current_semester', '1')->first())->id;
            $builder->where('semester_id', $semester_id);
        } else {
            $builder;
        }
    }
}
