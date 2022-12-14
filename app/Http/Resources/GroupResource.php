<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'name' => $this->name,
            'course_id' => optional($this->course)->name,
            'teacher_id' => optional($this->teacher)->name,
            'students' => $this->students ? StudentResource::collection($this->students)->resolve() : [],
            'group_students_number' => $this->students ? $this->students->count() : 0,
            'group_number' => $this->group_number,
            'attendance_days' => $this->attendance_days,
            'attendance_state' => $this->attendance_state,
            'attendance_state_string' => $this->attendance_state == 1 ? 'مفتوح' : 'مغلق',
            'grades_state' => $this->grades_state,
            'grades_state_string' => $this->grades_state == 1 ? 'مفتوح' : 'مغلق',
            'deleted_at' => $this->deleted_at?->diffForHumans(),
        ];
    }
}
