<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffInfo extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'name' => $this->name,
            'position' => $this->position,
            'faculty' => $this->faculty_id,
            'specialization' => $this->specialization,
            'area_of_interest' => $this->area_of_interest,
            'email' => $this->user->email
        ];
    }

}
