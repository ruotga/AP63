<?php

Class GestorEntidad{
    
    private $BBDD;

    public function __construct(){
        $this->BBDD = [];
    }

    public function Create($AD_AP, $Name, $vida, $mana){
        $this->BBDD[] = (($AD_AP == "AD")
        ? new AttackDamage($Name, $vida, $mana)
        : new AbilityPower($Name, $vida, $mana))
    }

    public function Read(){
        $BaseDatos=$this->BBDD;
        for ($i=0; $i < count($BaseDatos); $i++){ 
                $BaseDatos[$i]->mostar();
        }
    }

    public function Search($id){
        $BaseDatos=$this->BBDD;
        for ($i=0; $i < count($BaseDatos); $i++){ 
            if($BaseDatos[$i]->getNombre()==$id){
                $BaseDatos[$i]->mostrar();
                exit;
            }
            echo("No existe ningun campeón llamado ". $id ." en la base de datos" )
        }
    }

    public function Update($Name, $vida, $mana){
        $i=$_POST['Index_Champ'];
        $CAMPEON_EDITADO = $this->BBDD[$i]
        $CAMPEON_EDITADO->$vidaIni = $vida;
        $CAMPEON_EDITADO->$manaIni = $mana;
        $CAMPEON_EDITADO->$Nombre = $name;
        $this->BBDD[$i] = $CAMPEON_EDITADO;
    }

}

?>