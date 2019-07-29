<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FacultyStaff extends Model
{
    // Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    // One-To-One User Relationship
    public function user()
    {
        return $this->hasOne('App\User', 'user_id', 'id');
    }

    public function faculties()
    {
        return $this->hasMany('App\Model\Faculty', 'faculty_id', 'id');
    }
}
