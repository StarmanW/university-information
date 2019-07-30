<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProgrammeCertificate extends Model
{
    public function programmes()
    {
        return $this->belongsTo('App\Model\Programme');
    }

    public function certificates()
    {
        return $this->belongsTo('App\Model\Certificate');
    }
}
