<?php

namespace App\XML;

use App\Model\Campus;
use SplObjectStorage;

class CampusDOMParser
{
	private $campuses;

	public function __construct()
	{
		$this->campuses = new SplObjectStorage();
		$this->readFromXML();
	}

	public function readFromXML()
	{
		$xml = simplexml_load_file(asset('storage/xml/campus.xml'));
		$campuses = $xml->campus; // retrieve all the campuses nodes

		foreach ($campuses as $campus) {
			$campusTemp = new Campus();
			$campusTemp->id = $campus->id;
			$campusTemp->campus_name = $campus->campus_name;
			$campusTemp->campus_desc = $campus->campus_desc;
			$campusTemp->campus_location = $campus->campus_location;
			$this->campuses->attach($campusTemp);
		}
	}

	public function getParsedCampusesData()
	{
		return $this->campuses;
	}
}
