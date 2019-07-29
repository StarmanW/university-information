<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    public function campusFaculties()
    {
        return $this->hasMany('App\Model\CampusFaculty');
    }

    public function accomodations()
    {
        return $this->hasMany('App\Model\Accomodation');
    }

    public function campusProgrammes()
    {
        return $this->hasMany('App\Model\CampusProgramme');
    }
}
