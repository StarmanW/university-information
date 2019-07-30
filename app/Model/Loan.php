<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function programmeLoans()
    {
        return $this->hasMany('App\Model\ProgrammeLoan');
    }
}
