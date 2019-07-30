<?php

require_once 'app/Patterns/Observer/Subject.php';

class ProgrammeData extends Subject {
    private $Name, $Price, $Duration, $Level, $Requirement, $Certificate;
    
    public function __construct($Name, $Price, $Duration, $Level, $Requirement, $Certificate) {
        parent::__construct();
        $this->Name = $Name;
        $this->Price = $Price;
        $this->Duration = $Duration;
        $this->Level = $Level;
        $this->Requirement = $Requirement;
        $this->Certificate = $Certificate;
        
    }
    
    public function getName(){
        return $this->Name;
    }
    
    public function getPrice() {
        return $this->Price;
    }
    
    public function getDuration() {
        return $this->Duration;
    }
    
    public function getLevel(){
        return $this->Level;
    }
    
    public function getRequirement(){
        return $this->Requirement;
    }
    
    public function getCertificate() {
        return $this->Certificate;
    }
    
    public function setName($Name){
        $this->Name = $Name;
        $this->notify();
    }
    
    public function setPrice($Price){
        $this->Price = $Price;
        $this->notify();
    }
    
    public function setDuration($Duration){
        $this->Duration = $Duration;
        $this->notify();
    }
    
    public function setLevel($Level){
        $this->Level = $Level;
        $this->notify();
    }
    
    public function setRequirement($Requirement){
        $this->Requirement = $Requirement;
        $this->notify();
    }
    
    public function setCertificate($Certificate){
        $this->Certificate = $Certificate;
        $this->notify();
    }
    
    
    
}
