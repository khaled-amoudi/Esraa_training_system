<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'period' => $this->period,
            'group_id' => optional($this->group)->name,
            'semester_id' => $this->semester_id,
            'date' => $this->date,
            'day' => date('l', strtotime($this->date)),
            'coming_time' => date('h:i A', strtotime($this->coming_time)),
            'leaving_time' => date('h:i A', strtotime($this->leaving_time)),

            // data for show group
            'group_students' => optional($this->students),

        ];
    }
}
