<?php

Class AbilityPowerCamp extends Campeones{
    private $AP;
        
    public function __construct($nombre, $rol, $clase, $Power){
        parent::__construct($nombre, $rol, $clase);
        $this->AP = $Power;
    }

    public function getAP(){
        return $this->AP;
    }

    public function setAP($Power){
        $this->AP = $Power;
    }
}

?>