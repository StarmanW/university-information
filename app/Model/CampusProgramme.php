<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CampusProgramme extends Model
{
    public function programmes()
    {
        return $this->belongsTo('App\Model\Programme', 'prog_id', 'id');
    }

    public function campuses()
    {
        return $this->belongsTo('App\Model\Campus', 'campus_id', 'id');
    }
}
