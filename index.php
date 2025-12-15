<?php
require_once "autoloader.php";

$gestor = new GestorEntidad();

$roles = ["Top", "Jungla", "Mid", "ADC", "Support"];
$clases = ["Luchador", "Mago", "Asesino", "Tanque", "Tirador", "Soporte"];
$tiposDano = ["AD", "AP"];

for ($i = 1; $i <= 50; $i++) {
    
    $nombreAleatorio = "Camp " . $i;
    $rolAleatorio = $roles[array_rand($roles)];
    $claseAleatoria = $clases[array_rand($clases)];
    $tipoDanoAleatorio = $tiposDano[array_rand($tiposDano)];
    $danoAleatorio = rand(80, 200);

    $gestor->Crear($nombreAleatorio, $rolAleatorio, $claseAleatoria, $danoAleatorio, $tipoDanoAleatorio);
}

$campeonesIniciales = $gestor->Listar();


if (count($campeonesIniciales) >= 4) {
    
    $Camp1 = $campeonesIniciales[rand(0,49)];
    $Camp2 = $campeonesIniciales[rand(0,49)];
    $Camp3 = $campeonesIniciales[rand(0,49)];
    $Camp4 = $campeonesIniciales[rand(0,49)];
  
    $idCamp1 = $Camp1->getID();
    $idCamp2 = $Camp2->getID();
    $idCamp3 = $Camp3->getID();
    $idCamp4 = $Camp4->getID();

    echo "<p>Campeones actualizados: " . $Camp1->getNombre() . " y " . $Camp2->getNombre() . "</p>";
    echo "<p>Campeones eliminados: " . $Camp3->getNombre() . " y " . $Camp4->getNombre() . "</p>";

    // Actualiza 2
    $gestor->Actualizar($idCamp1, "Campeón Actualizado 1", "Top", "Tanque", 130);
    $gestor->Actualizar($idCamp2, "Campeón Actualizado 2", "Mid", "Mago", 150);

    // Elimina 2
    $gestor->Eliminar($idCamp3); 
    $gestor->Eliminar($idCamp4);
}


$campeones = $gestor->Listar();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Campeones - POO y Arrays</title>
</head>
<body>

<h2>Listado de Campeones</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Rol</th>
        <th>Clase</th>
        <th>Daño Base</th>
    </tr>

    <?php foreach ($campeones as $c): ?>
    <tr>
        <td><?= $c->getId() ?></td>
        <td><?= $c->getNombre() ?></td>
        <td><?= $c->getRol() ?></td>
        <td><?= $c->getTipo() ?></td>
        <td>
            <?php 
            if ($c instanceof AttackDamageCamp) {
                echo $c->getAD() . " (AD)"; 
            } elseif ($c instanceof AbilityPowerCamp) {
                echo $c->getAP() . " (AP)";
            } else {
                echo "desconocido.";
            }
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>