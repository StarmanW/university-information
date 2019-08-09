<?php
/**
 * Author - Samuel Wong Kim Foong
 */

namespace App\Patterns\Strategy;

use App\Model\Programme;

class DisplayProgramme implements ProgrammeMaintenance
{
    public function execute($request)
    {
        if ($request === null) {
            $programme = Programme::all();
            return $programme;
        } else {
            $programme = Programme::find($request);
            return $programme;
        }
    }
}
