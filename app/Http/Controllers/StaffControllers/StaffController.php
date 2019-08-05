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
        $this->saveXML($staffList->collection);

        $staffList = $proc->transformToXML($xml);

        if ($this->validateXML()) {
            return view('staff-list', ['staffList' => $staffList, 'XMLStatus' => true]);
        } else {
            return view('staff-list', ['staffList' => $staffList, 'XMLStatus' => false]);
        }
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

    public function saveXML($staffListArray) {
        //Creates XML string and XML document using the DOM 
        $dom = new DomDocument('1.0', 'UTF-8');

        $implementation = new \DOMImplementation();
        $dom->appendChild($implementation->createDocumentType('staffList SYSTEM \'staff.dtd\''));

        //add root
        $staffList = $dom->appendChild($dom->createElement('staffList'));

        for ($i = 0; $i < count($staffListArray); $i++) {

            //add track element to jukebox
            $staff = $dom->createElement('staff');
            $staffList->appendChild($staff);

            // Appending attributes
            $element = $dom->createElement('name');
            $element->appendChild($dom->createTextNode($staffListArray[$i]['name']));
            $staff->appendChild($element);
            $element = $dom->createElement('position');
            $element->appendChild($dom->createTextNode($staffListArray[$i]['position']));
            $staff->appendChild($element);
            $element = $dom->createElement('faculty');
            $element->appendChild($dom->createTextNode($staffListArray[$i]['faculty_id']));
            $staff->appendChild($element);
            $element = $dom->createElement('specialization');
            $element->appendChild($dom->createTextNode($staffListArray[$i]['specialization']));
            $staff->appendChild($element);
            $element = $dom->createElement('area_of_interest');
            $element->appendChild($dom->createTextNode($staffListArray[$i]['area_of_interest']));
            $staff->appendChild($element);
        }

        $dom->formatOutput = true; // set the formatOutput attribute of domDocument to true
        // save XML as string or file 
        $staffListXML = $dom->saveXML(); // put string in XML file

        $dom->save('../storage/app/public/xml/staff/staff_list.xml'); // save as file
    }

    public function validateXML() {
        $dom = new DOMDocument;
        $dom->Load('../storage/app/public/xml/staff/staff_list.xml');
        if ($dom->validate()) {
            return true;
        } else {
            return false;
        }
    }

    public function getStaffInfo() {
        return StaffInfoResource::collection(FacultyStaff::all());
    }

}
