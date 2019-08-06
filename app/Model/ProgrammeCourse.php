<?php

/**
 * Author - Samuel Wong Kim Foong
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProgrammeCourse extends Model
{
    public function programmes()
    {
        return $this->belongsTo('App\Model\Programme', 'prog_id', 'id');
    }

    public function courses()
    {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
}
