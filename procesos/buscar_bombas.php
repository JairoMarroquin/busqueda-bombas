<?php
require "../clases/Bombas.php";

$datos = array(
    "largo" => $_POST['largo'],
    "ancho" => $_POST['ancho'],
    "profundidad_minima" => $_POST['profundidad_minima'],
    "profundidad_maxima" => $_POST['profundidad_maxima']
);

$Bombas = new Bombas();
echo $Bombas->buscarBombas($datos);