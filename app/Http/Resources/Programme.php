<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Programme extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'faculty_id' => $this->faculty_id,
            'prog_name' => $this->prog_name,
            'prog_desc' => $this->prog_desc,
            'prog_mer' => $this->prog_mer,
            'prog_level' => $this->prog_level,
            'prog_duration' => $this->prog_duration
        ];
    }
}
