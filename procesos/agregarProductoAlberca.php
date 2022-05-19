<?php
include "../clases/Bombas.php";

if($_POST['objetivo'] == 1){
    $datos = array(
        "nombre" => $_POST['nombre_producto'],
        "hp" => $_POST['hp_producto'],
        "gpm" => $_POST['gpm_producto'],
        "tipo" => $_POST['tipo'],
        'objetivo' => $_POST['objetivo']
    );
}elseif($_POST['objetivo'] == 2){
    $lps = $_POST['lps_reg'];
    $lpm = $lps * 60;
    $gpm = ceil($lpm/3.785);

    $tipo = 1;
    $datos = array(
        "nombre" => $_POST['nombre_producto'],
        "hp" => $_POST['hp_producto'],
        "lps" => $_POST['lps_reg'],
        "cdt" => $_POST['carga_eficiente'],
        'objetivo' => $_POST['objetivo'],
        "gpm" => $gpm, 
        "tipo" => $tipo
    );
}

$Bombas = new Bombas();
echo $Bombas -> agregarProducto($datos);