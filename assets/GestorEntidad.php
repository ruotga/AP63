<?php

Class GestorEntidad{
    
    private $BBDD;

    public function __construct(){
        $this->BBDD = [];
    }

    public function getCampeones(){
        return $this->BBDD;
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

    public function Listar() {
    if (empty($this->BBDD)) {
        return "<p>No hay campeones registrados.</p>";
    }

    $html = "<table border=1>";
    $html .= "<thead>";
    $html .= "<tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Clase</th>
                <th>Tipo Daño</th>
                <th>A.Ataque</th>
              </tr>";
    $html .= "</thead>";
    $html .= "<tbody>";

    $total = count($this->BBDD);
    for ($i = 0; $i < $total; $i++) {
        $camp = $this->BBDD[$i];
        $html .= "<tr>";
        $html .= "<td>" . $camp->getID() . "</td>";
        $html .= "<td>" . $camp->getNombre() . "</td>";
        $html .= "<td>" . $camp->getRol() . "</td>";
        $html .= "<td>" . $camp->getTipo() . "</td>";

        if ($camp instanceof AttackDamageCamp) {
            $html .= "<td>Físico</td>";
            $html .= "<td>" . $camp->getAD() . "</td>";
        } elseif ($camp instanceof AbilityPowerCamp) {
            $html .= "<td>Mágico</td>";
            $html .= "<td>" . $camp->getAP() . "</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</tbody>";
    $html .= "</table>";

    return $html;
}

    
    public function Buscar($idBuscado) {
        foreach ($this->BBDD as $campeon) {
            if ($campeon->getID() == $idBuscado) {
                return $campeon;
            }
        }
        return null;
    }


    public function Actualizar($id, $nuevoNombre, $nuevoRol, $nuevaClase, $nuevosPuntos) {    
        $campeon = $this->Buscar($id);

        if ($campeon == null) {
            return false;
        }

        $campeon->setNombre($nuevoNombre);
        $campeon->setRol($nuevoRol);
        $campeon->setTipo($nuevaClase);

        if ($campeon instanceof AttackDamageCamp) {
            $campeon->setAD($nuevosPuntos);
        } elseif ($campeon instanceof AbilityPowerCamp) {
            $campeon->setAP($nuevosPuntos);
        }
        return $this->Listar();
    } 

    public function Eliminar($idBuscado){
    $OrganArray = []; 
    $total = count($this->BBDD);

    for ($i = 0; $i < $total; $i++) {
        if ($this->BBDD[$i]->getID() != $idBuscado) {
            $OrganArray[] = $this->BBDD[$i];
        }
    }
    $this->BBDD = $OrganArray;
    }
}

?>