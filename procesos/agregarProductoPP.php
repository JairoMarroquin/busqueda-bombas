<?php
include "clases/Bombas.php";
$val = 0;
$tp=0;
$cargaFriccionTotal= 0;

$tot_car= array_sum($_POST['carga']);       //se suman todas las cargas ingresadas

if($_POST['tanque_precargado'] == 1){       //se asigna el valor del tanque precargado segun el switch
    if($_POST['switch_presion'] == 1){
        $tp = 22;
    }elseif($_POST['switch_presion'] == 0){
        $tp = 35;
    }
}else{
    $tp = 0;
}

$lps = $_POST['lps'];
$lpm = $lps * 60;
$gpmCustom = $lpm / 3.785;                        //se calculan los galones por minuto

switch($lps){
    case 0.7:
        $gpm = 16;
        break;
    case 1:
        $gpm = 16;
        break;
    case 1.2:
        $gpm = 20;
        break;
    case 1.5:
        $gpm = 26;
        break;
    case 2:
        $gpm = 36;
        break;
    case 2.5:
        $gpm = 40;
        break;
    case 3:
        $gpm = 50;
        break;
}

foreach($_POST['diametro_val'] as $d => $diametro){
    switch([$gpm, $diametro]){
        //16 gpm
        case [16,1]:
            $val = 84.53;
            break;
        case [16,2]:
            $val = 23.68;
            break;
        case [16,3]:
            $val = 7.16;
            break;
        case [16,4]:
            $val = 2.29;
            break;
        case [16,5]:
            $val = 1.18;
            break;
        case [16,6]:
            $val = 0.40;
            break;
        //20 gpm
        case [20,2]:
            $val = 35.78;
            break;
        case [20,3]:
            $val = 10.82;
            break;
        case [20,4]:
            $val = 3.47;
            break;
        case [20,5]:
            $val = 1.79;
            break;
        case [20,6]:
            $val = 0.60;
            break;
        //26 gpm
        case [26,2]:
            $val = 58.14;
            break;
        case [26,3]:
            $val = 17.59;
            break;
        case [26,4]:
            $val = 5.64;
            break;
        case [26,5]:
            $val = 2.91;
            break;
        case [26,6]:
            $val = 0.98;
            break;
        //36 gpm
        case [36,3]:
            $val = 32.11;
            break;
        case [36,4]:
            $val = 10.30;
            break;
        case [36,5]:
            $val = 5.32;
            break;
        case [36,6]:
            $val = 1.80;
            break;
        //40gpm
        case [40,3]:
            $val = 39.03;
            break;
        case [40,4]:
            $val = 10.30;
            break;
        case [40,5]:
            $val = 5.32;
            break;
        case [40,6]:
            $val = 1.80;
            break;
        //50 gpm
        case [50,3]:
            $val = 58.97;
            break;
        case [50,4]:
            $val = 18.91;
            break;
        case [50,5]:
            $val = 9.78;
            break;
        case [50,6]:
            $val = 3.31;
            break;
    }
    $friccion[]= $val;
}

foreach($_POST['carga_friccion'] as $c => $cargaFriccion){
    $r3s[] = ($cargaFriccion * $friccion[$c]) / 100;
}

$cargasFriccionTotal= array_sum($r3s);
$sumaTotalCargasBusqueda= $tot_car + $tp +$cargasFriccionTotal;

$Bombas = new Bombas();
$Bombas -> buscarProductosPP($sumaTotalCargasBusqueda);