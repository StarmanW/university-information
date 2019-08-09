<?php
/**
 * Author - Samuel Wong Kim Foong
 */

namespace App\Patterns\Strategy;

use App\Model\Programme;

class DeleteProgramme implements ProgrammeMaintenance
{
    public function execute($request)
    {
        $prog = Programme::find($request);
        $prog->campusProgrammes()->delete();
        $prog->programmeCourses()->delete();
        $prog->programmeCertificates()->delete();
        $prog->programmeLoans()->delete();
        $prog->delete();
    }
}
