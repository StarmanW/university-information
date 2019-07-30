<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    public function campusFaculties()
    {
        return $this->hasMany('App\Model\CampusFaculty', 'campus_id', 'id');
    }

    public function accomodations()
    {
        return $this->hasMany('App\Model\Accomodation', 'campus_id', 'id');
    }

    public function campusProgrammes()
    {
        return $this->hasMany('App\Model\CampusProgramme', 'campus_id', 'id');
    }
}
