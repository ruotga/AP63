<?php

Class Campeones{
    Private $Nombre;
    private $vidaIni;
    private $manaIni;
    private $id

    public function __construct($name, $vida, $mana){
        $this->$vidaIni = $vida;
        $this->$manaIni = $mana;
        $this->$Nombre = $name;
        $this-$id = uniqid();
    }

    //Getters
    public function getNombre(){
            return $Nombre;
    }

    public function getVida(){
        return $vidaIni;
    }

    public function getmana(){
        return $manaIni;
    }

    //Setters
    public function setNombre($name){
            $this->$Nombre = $name;
        }

    public function setVida($vida){
        $this->$vidaIni = $vida;
        
    }

    public function setMana($mana){
        $this->$manaIni = $mana;
    }

    //other methods

    public function mostrar(){
        echo "<h2>".$this->$Nombre."</h2><br>
                <table>
                    <thead>
                    <tr>
                        <th>Vida</th>
                        <th>Mana</th>
                        <th>ID</th>
                    </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td>".$this->$ID."</td>
                        <td>".$this->$vidaIni."</td>
                        <td>".$this->$manaIni."</td>
                    </tr>
                </tbody>
            </table><br><br>";
    }
}

?>