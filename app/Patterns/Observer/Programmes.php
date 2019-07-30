<?php

namespace App\Patterns\Observer;

require_once 'app/Patterns/Observer/Observer.php';

class ComputerScience extends Observer {
    
    private $Name, $Price, $Duration, $Level, $Requirement, $Certificate, $subject;
    
    public function __construct($subject) {
        $this->subject = $subject;
        $this->subject->attach($this);
        $this->Name = $this->subject->getName();
        $this->Price = $this->subject->getPrice();
        $this->Duration = $this->subject->getDuration();
        $this->Level = $this->subject->getLevel();
        $this->Requirement = $this->subject->getRequirement();
        $this->Certificate = $this->subject->getCertificate();
        
    }
    
    public function update(){
        $this->Name = $this->subject->getName();
        $this->Price = $this->subject->getPrice();
        $this->Duration = $this->subject->getDuration();
        $this->Level = $this->subject->getLevel();
        $this->Requirement = $this->subject->getRequirement();
        $this->Certificate = $this->subject->getCertificate();
        
        echo"Infomation" . "<br />";
        echo"Name :" . $this->Name ."<br />";
        echo"Price :" . $this->Price . "<br />";
        echo"Duration:" . $this->Duration . "<br />";
        echo"Level:" . $this->Level . "<br />";
        echo"Requirment:" . $this->CRequirement . "<br />";
        echo"Certificate:" . $this->CCertificate . "<br />" . "</br>";
        
    }

    
}