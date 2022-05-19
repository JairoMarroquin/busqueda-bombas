<?php
include "../clases/Bombas.php";

if($_POST['objetivou'] == 1){
    $datos= array(
        'nombre' => $_POST['nombre_productou'],
        'hp' => $_POST['hp_productou'],
        'gpm' => $_POST['gpm_productou'],
        'tipo' => $_POST['tipou'],
        'objetivo' => $_POST['objetivou']
    );
}else{
    $datos= array(
        'nombre' => $_POST['nombre_productou'],
        'hp' => $_POST['hp_productou'],
        'tipo' => 1,
        "lps" => $_POST['lps_edi'],
        'objetivo' => $_POST['objetivou'],
        'carga_eficiente' => $_POST['carga_eficiente_edi']
    );
}

$Bombas = new Bombas();
echo $Bombas -> editarProductosAlberca($datos);
