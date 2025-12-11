<?php
//o	Crea un autoload.php
require_once 'autoloader.php';

$g = new GestorEntidad();

//o	Almacene 50 elementos en el array.
for ($i = 1; $i <= 50; $i++) {
    $par = ($i % 2 == 0);
    $g->Crear("Campeon $i", $par ? "Top" : "Mid", $par ? "Luchador" : "Mago", 100, $par ? "AD" : "AP");
}

echo "<h3>Listado Inicial (50):</h3>" . $g->Listar();

$Camps = $g->getCampeones();
$logEdit = [];
$logElim = [];

//o	Actualice 2.
for ($k = 0; $k < 2; $k++) {
    $idx = rand(0, 49);
    $camp = $Camps[$idx];
    $num = $idx + 1;
    $par = ($num % 2 == 0); //si la operación es igual al resultado s eentiende al conjunto como true.
    
    $logEdit[] = $camp->getNombre();
    $g->Actualizar($camp->getID(), "CampeonEdit $num", $par ? "Top" : "Mid", $par ? "Luchador" : "Mago", 999);
}

// o	Elimine 2.
for ($k = 0; $k < 2; $k++) {
    $idx = rand(0, 49);
    $camp = $Camps[$idx];
    
    $logElim[] = $camp->getNombre();
    $g->Eliminar($camp->getID());
}

// o	Finalmente, que muestre el listado de elementos.
echo "<h3>Reporte de Cambios:</h3>";
echo "<p><strong>Actualizados:</strong> " . implode(" y ", $logEdit) . "</p>";
echo "<p><strong>Eliminados:</strong> " . implode(" y ", $logElim) . "</p>";
echo "<h3>Listado Final (Modificado):</h3>" . $g->Listar();
?>