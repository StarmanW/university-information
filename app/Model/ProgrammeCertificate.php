<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProgrammeCertificate extends Model
{
    public function programmes()
    {
        return $this->belongsTo('App\Model\Programme', 'prog_id', 'id');
    }

    public function certificates()
    {
        return $this->belongsTo('App\Model\Certificate', 'cert_id', 'id');
    }
}
