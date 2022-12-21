<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'personalId' => $this->personalId,
            'attendance_state' => $this->attendance_state,
            'role' => $this->role,
            'groups' => $this->groups ? $this->groups : [],
            'teacherAttendances' => $this->teacherAttendances ? TeacherAttendanceResource::collection($this->teacherAttendances)->resolve() : [],
            'deleted_at' => $this->deleted_at?->diffForHumans(),
        ];
    }
}
