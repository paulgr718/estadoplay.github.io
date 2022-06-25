<?php
include_once '../conexion/cls_conexion.php';

 
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta

        $consulta = "INSERT INTO categoria (categoria) VALUES('$categoria') ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

           $consulta = "SELECT * from categoria ORDER BY id DESC LIMIT 1 ;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	
        
       
        break;
    case 2: //modificación
        $consulta = "UPDATE categoria SET categoria='$categoria' WHERE id='$id' ";   
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM categoria WHERE id=$id ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM categoria WHERE id='$id' ";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        
         $consulta = "SELECT * FROM categoria WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
