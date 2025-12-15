<?php

Class AttackDamageCamp extends Campeones{
    private $AD;
    
    public function __construct($nombre, $rol, $clase, $Damage){
        parent::__construct($nombre, $rol, $clase);
        $this->AD = $Damage;
    }

    public function getAD(){ return $this->AD; }

    public function setAD($Damage){ $this->AD = $Damage; }
}

?>



