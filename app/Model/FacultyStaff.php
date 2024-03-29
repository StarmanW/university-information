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
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // Many-to-One Faculty relationship
    public function faculties()
    {
        return $this->belongsTo('App\Model\Faculty', 'faculty_id', 'id');
    }
}
