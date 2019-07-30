<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CampusFaculty extends Model
{
    public function faculties()
    {
        return $this->belongsTo('App\Model\Faculty', 'faculty_id', 'id');
    }

    public function campuses()
    {
        return $this->belongsTo('App\Model\Campus', 'campus_id', 'id');
    }
}
