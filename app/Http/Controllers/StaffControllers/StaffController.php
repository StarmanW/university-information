<?php

namespace App\Http\Controllers\StaffControllers;

use Illuminate\Http\Request;
use App\Model\FacultyStaff;
use App\Http\Controllers\Controller;
use DOMDocument;
use XSLTProcessor;
use SimpleXMLElement;
use App\Http\Resources\StaffInfo as StaffInfoResource;

class StaffController extends Controller {

    public function index() {

        $staffList = $this->getStaffInfo();
        $jsonstaffList = json_decode($staffList->collection, true);
        $xmlStaffList = $this->arrayToXML($jsonstaffList, false);

        $xml = new DOMDocument('1.0', 'UTF-8');
        $xslt = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="staff_list.xsl"');
        $xml->appendChild($xslt);
        $xml->loadXML($xmlStaffList);

        // Load XSLT file
        $xsl = new DOMDocument();
        $xsl->load(asset('storage/xml/staff/staff_list.xsl'));

        // Create XSLT Processor
        $proc = new XSLTProcessor();
        $proc->importStyleSheet($xsl);

        $staffList = $proc->transformToXML($xml);

        return view('staff-list')->with('staffList', $staffList);
    }

    public function arrayToXML($array, $xml = false) {
        if ($xml === false) {
            $xml = new SimpleXMLElement('<staffList/>');
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->arrayToXML($value, $xml->addChild("staff"));
            } else {
                $xml->addChild($key, $value);
            }
        }
        return $xml->asXML();
    }

    public function getStaffInfo() {
        return StaffInfoResource::collection(FacultyStaff::all());
    }

}
