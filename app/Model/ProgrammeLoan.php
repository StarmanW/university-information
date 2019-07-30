<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProgrammeLoan extends Model
{
    public function programmes()
    {
        return $this->belongsTo('App\Model\Programme', 'prog_id', 'id');
    }

    public function loans()
    {
        return $this->belongsTo('App\Model\Loan', 'loan_id', 'id');
    }
}
