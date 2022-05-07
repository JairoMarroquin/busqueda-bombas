<?php

include "../config/conexion.php";

    class Bombas extends Conexion {

        public function buscarBombas($datos){
            $largo = $datos['largo'];
            $ancho = $datos['ancho']; //RECOPILO LAS MEDIDAS DE LA ALBERCA
            $profundidad_minima = $datos['profundidad_minima'];
            $profundidad_maxima = $datos['profundidad_maxima'];

            //SE HACEN LOS CALCULOS
            $pp = ($profundidad_minima + $profundidad_maxima) / 2;          //profundidad promedio
            $mts3 = $largo * $ancho * $pp;                                  //metros cubicos
            $lts = $mts3 * 1000;                                            //litros
            $gal = $lts / 3.785;                                            //galones
            $gpm = $gal / 360;                                              //GPM
            $gpm2 = $gpm + 15;                                            //se amplia el rango de busqueda

            //PISO VENECIANO
            $piso = $largo * $ancho;
            $p1 = ($largo * $profundidad_maxima)*2;
            $p2 = ($ancho * $profundidad_maxima)*2;

            $conexion = Conexion::conectar();
            $sql = "SELECT nombre, hp, gpm, tipo FROM bombas_alberca WHERE gpm BETWEEN '$gpm' AND '$gpm2' AND eliminado = 0 ORDER BY gpm ASC LIMIT 7";
            $respuesta = mysqli_query($conexion, $sql);
            sleep(1);
            if(mysqli_num_rows($respuesta)> 0){
                $mData=array('status'=>true);
                while($bombas = mysqli_fetch_assoc($respuesta)){
                    $bombas['gpm_enviado']=round($gpm, 2);
                    $mData['data'][]=$bombas;
                }
            }else{
                $mData=array('status'=>false, 'msg'=>'No se encontraron productos compatibles.');
            }
            return json_encode($mData); 
        }
        public function agregarProducto($datos){
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO bombas_alberca (nombre, hp, gpm, tipo, objetivo) VALUES (?, ?, ?, ?, ?)"; 
            $query=$conexion->prepare($sql);
            $query-> bind_param('sssii', $datos['nombre'],$datos['hp'],$datos['gpm'],$datos['tipo'],$datos['objetivo']);
            $respuesta= $query->execute();
            $query->close();
            return $respuesta;
        }
        public function eliminarProducto($id){
            $conexion = Conexion::conectar();
            $sql = "UPDATE bombas_alberca SET eliminado = 1 WHERE id_bomba = '$id'";
            $respuesta = mysqli_query($conexion, $sql);
            return $respuesta;
        }
        public function obtenerDatosEditar($id){
            $conexion = Conexion::conectar();
            $sql = "SELECT * FROM bombas_alberca WHERE id_bomba = '$id'";
            $respuesta = mysqli_query($conexion, $sql);
            $bomba = mysqli_fetch_array($respuesta);
            $datos = array(
                'id' => $bomba['id_bomba'],
                'nombre' => $bomba['nombre'],
                'hp' => $bomba['hp'],
                'gpm' => $bomba['gpm'],
                'tipo' => $bomba['tipo'],
                'objetivo' => $bomba['objetivo']
            );
            return $datos;
        }
        public function editarProductosAlberca($datos){
            $conexion = Conexion::conectar();
            $id = $_POST['idBombaEditar'];
            $sql = "  UPDATE bombas_alberca SET     nombre = ?,
                                                    hp = ?,
                                                    gpm = ?,
                                                    tipo = ?,
                                                    objetivo = ?
                        WHERE id_bomba = '$id'";
            $query = $conexion -> prepare($sql);
            $query-> bind_param('sssii', $datos['nombre'], $datos['hp'], $datos['gpm'], $datos['tipo'],$datos['objetivo']);
            $respuesta = $query->execute();
            $query->close();

            return $respuesta;
        }
    }