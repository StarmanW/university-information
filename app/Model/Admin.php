<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    // One-To-One User Relationship
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
