<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Base5Controller;
use App\Models\Semester;
use App\Models\Year;

class YearController extends Base5Controller
{
    public $route_view_name = "dashboard.year";


    public function saving($request, $model)
    {

        $semester = new Semester();
        // update the status of the current year to (0) to all years except the new year if its status = 1
        // if($model->is_current_year == 1){
        //     $this->getModel()::where('id', '!=', $model->id)->where('is_current_year', 1)->update([
        //         'is_current_year' => 0
        //     ]);
        // }


        // update the status of the current semester to (0) to all semesters before create the new two semesters
        if($request->has('is_current_semester') && $request->is_current_semester != ''){
            $semester->where('is_current_semester', 1)->update([
                'is_current_semester' => 0
            ]);
        }


        if($request->has('is_current_semester')){
            $current_semester = $request->is_current_semester;
            if($current_semester == '1'){
                $first_semester = 1;
                $second_semester = 0;
            } elseif($current_semester == '2'){
                $first_semester = 0;
                $second_semester = 1;
            } else {
                $first_semester = 0;
                $second_semester = 0;
            }
        }

        // create two default semesters to the new year
        $semesters = [
            ['name' => 'الفصل الأول - '. $model->year, 'year_id' => $model->id, 'is_current_semester' => $first_semester],
            ['name' => 'الفصل الثاني - '. $model->year, 'year_id' => $model->id, 'is_current_semester' => $second_semester]
        ];
        foreach($semesters as $semester){
            Semester::create($semester);
        }
    }
}
