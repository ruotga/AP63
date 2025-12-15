<?php

Class GestorEntidad{
    
    private $BBDD;

    public function __construct(){
        $this->BBDD = [];
    }

    public function Crear($nombre, $rol, $clase, $daño, $tipoDaño){
        if($tipoDaño == "AD"){
            $this->BBDD[] = new AttackDamageCamp($nombre, $rol, $clase, $daño);
        }elseif($tipoDaño == "AP"){
            $this->BBDD[] = new AbilityPowerCamp($nombre, $rol, $clase, $daño);
        }else{
            exit("Tipo de daño desconocido, inserta un tipo de daño valido.");
        }
    }

    public function Listar(){
        return $this->BBDD;
    }
    
    public function Buscar($idBuscado) {
        foreach ($this->BBDD as $campeon) {
            if ($campeon->getID() == $idBuscado) { return $campeon; }
        }
        return null;
    }

    public function Actualizar($id, $Nombre, $Rol, $Clase, $Puntos) {    
        foreach ($this->BBDD as $c) {
            if($c->getId() == $id) {
                $c->setNombre($Nombre);
                $c->setRol($Rol);
                $c->setTipo($Clase);
                if($c instanceof AttackDamageCamp){
                    $c->setAD($Puntos);
                }elseif($c instanceof AbilityPowerCamp){
                    $c->setAP($Puntos);
                }else{
                    exit("ERROR.");
                }
            }
        }
    } 



    public function Eliminar($id) {
        foreach ($this->BBDD as $i => $c) {
            if ($c->getId() == $id) {
                unset($this->BBDD[$i]);
                $this->BBDD = array_values($this->BBDD);
                return true;
            }
        }
        return false;
    }
}

?>