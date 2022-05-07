<?php

include "../clases/Bombas.php";
$Bombas = new Bombas();

$id = $_POST['id'];
echo $Bombas -> eliminarProducto($id);