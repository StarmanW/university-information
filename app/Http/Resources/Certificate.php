<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Certificate extends JsonResource
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
            'cert_name' => $this->cert_name,
            'cert_desc' => $this->cert_desc,
            'programmes' => $this->programmeCertificates
        ];
    }
}
