<?php
$id = $_POST['id'];
include "../clases/Bombas.php";
$Bombas = new Bombas();
echo json_encode($Bombas->obtenerDatosEditar($id));