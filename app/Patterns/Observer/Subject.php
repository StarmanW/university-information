<?php
namespace app\Patterns\Observer;



abstract class Subject {
    protected $observers;
    
    public function __construct() {
        $this->observers = array();
    }
    public function attach($ob){//add an observer to this subject's array
        array_push($this->observers, $ob);
    }

    public function detach($ob){//remove an observer from this subject's array
        $pos =0;
        foreach($this->observers as $currentObs){
            if($currentObs ==$ob){
                array_splice($this->observers,$pos,1);
                return;
            }
            $pos++;
        }
        
    }
    
    public function notify(){
        foreach($this->observers as $ob){
            $ob->update();
        }
    }
}
