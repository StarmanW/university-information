<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    // Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    // Many-To-One Campus Relationship
    public function campuses()
    {
        return $this->belongsTo('App\Models\Campus');
    }
}
