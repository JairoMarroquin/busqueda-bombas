<?php
include "../clases/Bombas.php";

$datos= array(
    'nombre' => $_POST['nombre_productou'],
    'hp' => $_POST['hp_productou'],
    'gpm' => $_POST['gpm_productou'],
    'tipo' => $_POST['tipou'],
    'objetivo' => $_POST['objetivou']
);

$Bombas = new Bombas();
echo $Bombas -> editarProductosAlberca($datos);
