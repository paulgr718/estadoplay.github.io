<?php
include_once '../conexion/cls_conexion.php';

/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
// Recepción de los datos enviados mediante POST desde el JS   
$estado = 'a';
$serie = (isset($_POST['serie'])) ? $_POST['serie'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta

		 $consulta = "INSERT INTO tipo (serie, marca, nombre) VALUES('$serie', '$marca', '$nombre') ";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, serie, marca, nombre FROM tipo ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);;
	
        
       
        break;
    case 2: //modificación
        $consulta = "UPDATE tipo SET serie='$serie', marca='$marca', nombre='$nombre' WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, serie, marca, nombre FROM tipo WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM tipo WHERE id='$id' ";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        
         $consulta = "SELECT id, serie, marca, nombre FROM tipo WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
