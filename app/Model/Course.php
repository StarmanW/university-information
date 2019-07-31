<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    public function programmeCourses()
    {
        return $this->hasMany('App\Model\ProgrammeCourse', 'course_id', 'id');
    }

    public function faculty()
    {
        return $this->hasMany('App\Model\Faculty', 'faculty_id', 'id');
    }
}
