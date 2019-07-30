<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    // Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    public function facultyStaffs()
    {
        return $this->hasMany('App\Model\FacultyStaff');
    }

    public function programmes()
    {
        return $this->hasMany('App\Model\Programme');
    }

    public function campusFaculties()
    {
        return $this->hasMany('App\Model\CampusFaculty');
    }
}
