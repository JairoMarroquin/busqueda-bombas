<?php
include "../clases/Bombas.php";
$val = 0;
$tp = 0;
$cargaFriccionTotal = 0;
$it_gpm = 0;
$tot_car = array_sum($_POST['carga']);               //se suman todas las cargas ingresadas

if($_POST['tanque_precargado'] == 1){               //se asigna el valor del tanque precargado segun el switch
    if($_POST['switch_presion'] == 1){
        $tp = 22;
    }elseif($_POST['switch_presion'] == 0){
        $tp = 35;
    }
}else{
    $tp = 0;
}

if($_POST['custom_lps'] == 1){
    $lps = $_POST['lps_custom'];
    $lpm = $lps * 60;
    $gpmCustom = $lpm / 3.785; 
    $gpmValues= array(2,4,6,8,10,16,20,26,30,36,40,46,50,60);

    foreach($gpmValues as $gpmVal => $gpmFor){
        $gpm = ceil(($gpmCustom/$gpmFor))* $gpmFor;
        if($gpm <= $gpmFor){
            break;
        }else{
            $it_gpm++;
        }
        if($gpmCustom > 60){
            echo '-1';
            die();
        }
    }
}else{
    $lps = $_POST['lps'];
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
} 

foreach($_POST['diametro_val'] as $d => $diametro){
    switch([$gpm, $diametro]){
        //2 gpm
        case [2,1]:
            $val = 1.80;
            break;
        case [2,2]:
            $val = 0.50;
            break;
        case [2,3]:
            $val = 0.15;
            break;
        case [2,4]:
            $val = 0.04;
            break;
        case [2,5]:
            $val = 0.02;
            break;
        //4 gpm
        case [4,1]:
            $val = 6.50;
            break;
        case [4,2]:
            $val = 1.82;
            break;
        case [4,3]:
            $val = 0.55;
            break;
        case [4,4]:
            $val = 0.17;
            break;
        case [4,5]:
            $val = 0.09;
            break;
        case [4,6]:
            $val = 0.03;
            break;
        // 6 gpm
        case [6,1]:
            $val = 13.77;
            break;
        case [6,2]:
            $val = 3.85;
            break;
        case [6,3]:
            $val = 1.16;
            break;
        case [6,4]:
            $val = 0.37;
            break;
        case [6,5]:
            $val = 0.19;
            break;
        case [6,6]:
            $val = 0.06;
            break;
        //8 gpm
        case [8,1]:
            $val = 23.45;
            break;
        case [8,2]:
            $val = 6.56;
            break;
        case [8,3]:
            $val = 1.98;
            break;
        case [8,4]:
            $val = 0.63;
            break;
        case [8,5]:
            $val = 0.32;
            break;
        case [8,6]:
            $val = 0.11;
            break;
        //10 gpm
        case [10,1]:
            $val = 35.43;
            break;
        case [10,2]:
            $val = 9.92;
            break;
        case [10,3]:
            $val = 3;
            break;
        case [10,4]:
            $val = 0.96;
            break;
        case [10,5]:
            $val = 0.49;
            break;
        case [10,6]:
            $val = 0.16;
            break;
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
        //30 gpm
        case [30,2]:
            $val = 75.76;
            break;
        case [30,3]:
            $val = 22.92;
            break;
        case [30,4]:
            $val = 7.35;
            break;
        case [30,5]:
            $val = 3.80;
            break;
        case [30,6]:
            $val = 1.28;
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
        //46 gpm
        case [46,3]:
            $val = 50.54;
            break;
        case [46,4]:
            $val = 16.21;
            break;
        case [46,5]:
            $val = 8.38;
            break;
        case [46,6]:
            $val = 2.83;
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
        //60 gpm
        case [60,3]:
            $val = 82.63;
            break;
        case [60,4]:
            $val = 26.35;
            break;
        case [60,5]:
            $val = 13.70;
            break;
        case [60,6]:
            $val = 4.63;
            break;
    }
    $friccion[] = $val;
    if($val == 0){
        echo '-2';
        die();
    }
}

foreach($_POST['carga_friccion'] as $c => $cargaFriccion){
    $r3s[] = ($cargaFriccion * $friccion[$c]) / 100;
}

$cargasFriccionTotal= array_sum($r3s);
$cdt = $tot_car + $tp + $cargasFriccionTotal;

// Calculos del HP
$roundHp = 0;
$roundHp = (($cdt*$gpm)/1365);
$hpValues= array(0.5, 1, 1.5, 2, 3, 5);

foreach($hpValues as $hpVal => $hpFor){
    $hp = ceil(($roundHp/$hpFor))*$hpFor;
    if($hp <= $hpFor){
        break;
    }else{
        $hp = "El valor es muy alto. No se puede calcular.";
    }
}

$datos= array(
    "hp" => $hp, 
    "gpm" => $gpm,
    "cdt" => $cdt
);

$Bombas = new Bombas();
echo $Bombas -> buscarProductosPP($datos);