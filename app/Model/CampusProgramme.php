<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CampusProgramme extends Model
{
    public function programmes()
    {
        return $this->belongsTo('App\Model\Programme');
    }

    public function campuses()
    {
        return $this->belongsTo('App\Model\Campus');
    }
}
