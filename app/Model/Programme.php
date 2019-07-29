<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    // Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    public function faculties()
    {
        return $this->belongsTo('App\Model\Faculty');
    }

    public function campusProgrammes()
    {
        return $this->hasMany('App\Model\CampusProgramme');
    }

    public function programmeCourses()
    {
        return $this->hasMany('App\Model\ProgrammeCourse');
    }

    public function programmeCertificates()
    {
        return $this->hasMany('App\Model\ProgrammeCertificate');
    }

    public function programmeLoans()
    {
        return $this->hasMany('App\Model\ProgrammeLoan');
    }
}
