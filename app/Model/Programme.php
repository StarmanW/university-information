<?php
/**
 * Author - Samuel Wong Kim Foong
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    // Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    public function faculties()
    {
        return $this->belongsTo('App\Model\Faculty', 'faculty_id', 'id');
    }

    public function campusProgrammes()
    {
        return $this->hasMany('App\Model\CampusProgramme', 'prog_id', 'id');
    }

    public function programmeCourses()
    {
        return $this->hasMany('App\Model\ProgrammeCourse', 'prog_id', 'id');
    }

    public function programmeCertificates()
    {
        return $this->hasMany('App\Model\ProgrammeCertificate', 'prog_id', 'id');
    }

    public function programmeLoans()
    {
        return $this->hasMany('App\Model\ProgrammeLoan', 'prog_id', 'id');
    }
}
