<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CampusFaculty extends Model
{
    public function faculties()
    {
        return $this->belongsTo('App\Model\Faculty');
    }

    public function campuses()
    {
        return $this->belongsTo('App\Model\Campus');
    }
}
