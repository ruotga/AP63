<?php

Class GestorEntidad{
    
    private $BBDD;

    public function __construct(){
        if(!isset($_SESSION['Camps']))
        $_SESSION['Camps'] = [];
    }

    public function Crear($nombre, $rol, $clase, $daño, $tipoDaño){
        if($tipoDaño == "AD"){
            $_SESSION['Camps'][] = new AttackDamageCamp($nombre, $rol, $clase, $daño);
        }elseif($tipoDaño == "AP"){
            $_SESSION['Camps'][] = new AbilityPowerCamp($nombre, $rol, $clase, $daño);
        }
    } 

    public function Listar(){
        return $_SESSION['Camps'];
    }
    
    public function Buscar($idBuscado) {
        foreach ($_SESSION['Camps'] as $campeon) {
            if ($campeon->getID() == $idBuscado) { return $campeon; }
        }
        return null;
    }

    public function Actualizar($id, $Nombre, $Rol, $Clase, $Puntos) {    
        foreach ($_SESSION['Camps'] as $c) {
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
        foreach ($_SESSION['Camps'] as $i => $c) {
            if ($c->getId() == $id) {
                unset($_SESSION['Camps'][$i]);
                $_SESSION['Camps'] = array_values($_SESSION['Camps']);
                return true;
            }
        }
        return false;
    }
}

?>