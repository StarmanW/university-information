<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FacultyAdmin extends Model
{
    // One-To-One User Relationship
    public function user()
    {
        return $this->hasOne('App\User', 'user_id', 'id');
    }

    // Many-to-One Faculty relationship
    public function faculties()
    {
        return $this->belongsTo('App\Model\Faculty', 'faculty_id', 'id');
    }
}
