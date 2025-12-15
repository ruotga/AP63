<?php

Class Campeones{
    protected $id;
    protected $nombre;
    protected $rol;
    protected $tipo;

    public function __construct($nombre, $rol, $clase){
        $this->id = uniqid();
        $this->nombre = $nombre;
        $this->rol = $rol;
        $this->tipo = $clase;

    }

    //Getters
    public function getID(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }
    public function getTipo(){ return $this->tipo; }
    public function getRol(){ return $this->rol; }

    //Setters
    public function setNombre($name){ $this->nombre = $name; }
    public function setTipo($clase){ $this->tipo = $clase; }
    public function setRol($posicion){ $this->rol = $posicion; }

}
?>

