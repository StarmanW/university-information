<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function programmeCertificates()
    {
        return $this->hasMany('App\Model\ProgrammeCertificate');
    }
}
