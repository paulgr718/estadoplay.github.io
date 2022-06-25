<?php
include_once '../conexion/cls_conexion.php';

/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
// Recepción de los datos enviados mediante POST desde el JS   
$estado = 'a';
$estado2 = 'i';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_cliente = (isset($_POST['id_cliente'])) ? $_POST['id_cliente'] : '';

switch($opcion){
    case 1: //alta

        $consulta = "INSERT INTO cliente (nombre, estado) VALUES('$nombre','$estado') ";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * from cliente where estado='a' ORDER BY id_cliente DESC LIMIT 1 ;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);;
	
        
       
        break;
    case 2: //modificación
        $consulta = "UPDATE cliente SET nombre='$nombre' WHERE id_cliente='$id_cliente' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM cliente WHERE id_cliente='$id_cliente' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "UPDATE cliente SET estado='$estado2'WHERE id_cliente='$id_cliente' ";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        
         $consulta = "SELECT * FROM cliente WHERE id_cliente='$id_cliente' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
