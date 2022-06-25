<?php
include_once '../conexion/cls_conexion.php';

/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
// Recepción de los datos enviados mediante POST desde el JS   
$estado = 'a';
$num_equipo = (isset($_POST['num_equipo'])) ? $_POST['num_equipo'] : '';
$equipo = (isset($_POST['equipo'])) ? $_POST['equipo'] : '';
$id_tipo = (isset($_POST['id_tipo'])) ? $_POST['id_tipo'] : '';
$precio_uso = (isset($_POST['precio_uso'])) ? $_POST['precio_uso'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
        case 1: //alta

                $consulta = "INSERT INTO dispositivos (num_equipo, equipo, precio_uso, id_tipo, estado_e, estado_c) VALUES('$num_equipo', '$equipo', '$precio_uso', '$id_tipo', 'a','disponible') ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                $consulta = "select dp.id, dp.num_equipo, dp.equipo, dp.id_tipo, tp.serie, tp.marca, tp.nombre,dp.precio_uso
from dispositivos dp
inner join tipo tp on dp.id_tipo = tp.id ORDER BY dp.id DESC LIMIT 1";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

                /*$consulta = "select dp.id, dp.num_equipo, dp.equipo, dp.id_tipo, tp.serie, tp.marca, tp.nombre,dp.precio_uso
from dispositivos dp
inner join tipo tp on dp.id_tipo = tp.id ORDER BY dp.id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);;*/



                break;
        case 2: //modificación
                $consulta = "UPDATE dispositivos SET num_equipo=$num_equipo, equipo='$equipo', precio_uso='$precio_uso', id_tipo=$id_tipo WHERE id=$id ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                $consulta = "select dp.id, dp.num_equipo, dp.equipo, dp.id_tipo, tp.serie, tp.marca, tp.nombre,dp.precio_uso
from dispositivos dp
inner join tipo tp on dp.id_tipo = tp.id WHERE dp.id='$id' ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                break;
        case 3: //baja
                $consulta = "DELETE FROM dispositivos WHERE id='$id' ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                $consulta = "select dp.id, dp.num_equipo, dp.equipo, dp.id_tipo, tp.serie, tp.marca, tp.nombre,dp.precio_uso
from dispositivos dp
inner join tipo tp on dp.id_tipo = tp.id WHERE dp.id='$id' ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
