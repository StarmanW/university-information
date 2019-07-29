<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProgrammeCourse extends Model
{
    public function programmes()
    {
        return $this->belongsTo('App\Model\Programme');
    }

    public function courses()
    {
        return $this->belongsTo('App\Model\Course');
    }
}
