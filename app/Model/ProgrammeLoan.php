<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProgrammeLoan extends Model
{
    public function programmes()
    {
        return $this->belongsTo('App\Model\Programme');
    }

    public function loans()
    {
        return $this->belongsTo('App\Model\Loan');
    }
}
