<?php
include "../clases/Bombas.php";

$datos = array(
    "nombre" => $_POST['nombre_producto'],
    "hp" => $_POST['hp_producto'],
    "gpm" => $_POST['gpm_producto'],
    "tipo" => $_POST['tipo'],
    'objetivo' => $_POST['objetivo']
);

$Bombas = new Bombas();
echo $Bombas -> agregarProducto($datos);