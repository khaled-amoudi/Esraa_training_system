<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'course_number' => $this->course_number,
            'semester_id' => optional($this->semester)->name,
            'degree' => $this->degree,
            // 'groups' => GroupResource::collection($this->groups),
            'groups' => $this->groups ? $this->groups : [],
            'deleted_at' => $this->deleted_at?->diffForHumans(),
        ];
    }
}
