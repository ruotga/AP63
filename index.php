<?php
require_once "autoloader.php";
session_start();

$gestor = new GestorEntidad();
$accion = $_GET['accion'] ?? null;

if ($accion == 'crear') {
    $gestor->Crear($_POST['nombre'], $_POST['rol'], $_POST['clase'], $_POST['daño'], $_POST['tipoDaño']);
    header("Location: index.php");
    exit;
}

if ($accion == 'actualizar') {
    $gestor->Actualizar($_POST['id'], $_POST['nombre'], $_POST['rol'], $_POST['clase'], $_POST['daño']);
    header("Location: index.php");
    exit;
}

if ($accion == 'eliminar') {
    $gestor->Eliminar($_GET['id']);
    header("Location: index.php");
    exit;
}

if ($accion == 'vaciar') {
    unset($_SESSION['Camps']);
    header("Location: index.php");
    exit;
}

$campeonAEditar = (isset($_GET['editar'])) ? $gestor->Buscar($_GET['editar']) : null;
$campeones = $gestor->Listar();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUDv2</title>
    <style>
        form {
            background-color: lightgrey; padding: 10px;
        }
        
        input, select{
            margin-bottom: 5px;
        }

        th,td,tr{
            padding: 5px;
        }
    </style>
</head>
<body>

<h2><?= $campeonAEditar ? "Editar" : "Crear" ?> Campeón</h2>
        
<form method="POST" action="index.php?accion=<?= $campeonAEditar ? 'actualizar' : 'crear' ?>">
    <?php if ($campeonAEditar): ?>
        <input type="hidden" name="id" value="<?= $campeonAEditar->getID() ?>">
    <?php endif; ?>

        <span>|</span>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?= $campeonAEditar ? $campeonAEditar->getNombre() : '' ?>" required>
        <span>|</span>
    <label for="rol">Rol:</label>
    <input type="text" id="rol" name="rol" value="<?= $campeonAEditar ? $campeonAEditar->getRol() : '' ?>" required>
        <span>|</span><br>
        <span>|</span>
    <label for="clase">Clase:</label>
    <input type="text" id="clase" name="clase" value="<?= $campeonAEditar ? $campeonAEditar->getTipo() : '' ?>" required>
        <span>|</span>
    <label for="daño">Daño:</label>
    <input type="number" id="daño" name="daño" value="<?= $campeonAEditar ? ($campeonAEditar instanceof AttackDamageCamp ? $campeonAEditar->getAD() : $campeonAEditar->getAP()) : '' ?>" required>
        <span>|</span><br>
        
    <?php if (!$campeonAEditar): ?>
        <span>|</span>
        <label for="tipoDaño">Tipo:</label>
        <select id="tipoDaño" name="tipoDaño">
            <option value="AD">AD</option>
            <option value="AP">AP</option>
        </select>
        <span>|</span><br>
    <?php endif; ?>
        
    <button type="submit"><?= $campeonAEditar ? "Actualizar" : "Guardar" ?></button>

    <?php if (!$campeonAEditar): ?>
        <span>|</span>
        <a href="index.php?accion=vaciar">
            <button type="button" style="background-color: #ff6565ff; border: 1px solid red; cursor: pointer;">
                Vaciar Lista
            </button>
        </a>
    <?php endif; ?>
</form>
<hr>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Rol</th>
        <th>Clase</th>
        <th>Daño</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($campeones as $campeon): ?>
    <tr>
        <td><?= $campeon->getID() ?></td>
        <td><?= $campeon->getNombre() ?></td>
        <td><?= $campeon->getRol() ?></td>
        <td><?= $campeon->getTipo() ?></td>
        <td>
            <?= ($campeon instanceof AttackDamageCamp) ? $campeon->getAD() . " | AD" : $campeon->getAP() . " | AP" ?>
        </td>
        <td>
            <a href="index.php?editar=<?= $campeon->getID() ?>">Editar</a>
            <span> | </span>
            <a href="index.php?accion=eliminar&id=<?= $campeon->getID() ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>