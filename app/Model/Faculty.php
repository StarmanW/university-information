<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    // Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    public function facultyStaffs()
    {
        return $this->hasMany('App\Model\FacultyStaff', 'faculty_id', 'id');
    }

    public function programmes()
    {
        return $this->hasMany('App\Model\Programme', 'faculty_id', 'id');
    }

    public function campusFaculties()
    {
        return $this->hasMany('App\Model\CampusFaculty', 'faculty_id', 'id');
    }
}
