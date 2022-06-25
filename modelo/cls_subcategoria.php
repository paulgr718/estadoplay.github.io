<?php
include_once '../conexion/cls_conexion.php';

/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
// Recepción de los datos enviados mediante POST desde el JS   
$estado = 'a';
$subcategoria = (isset($_POST['subcategoria'])) ? $_POST['subcategoria'] : '';
$id_categoria = (isset($_POST['id_categoria'])) ? $_POST['id_categoria'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta

		 $consulta = "INSERT INTO subcategoria (subcategoria, id_categoria) VALUES('$subcategoria', '$id_categoria') ";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "select su.id, su.subcategoria, su.id_categoria, cat.categoria
from subcategoria su
inner join categoria cat on su.id_categoria = cat.id
ORDER BY su.id DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        
       
        break;
    case 2: //modificación
        $consulta = "UPDATE subcategoria SET subcategoria='$subcategoria',id_categoria='$id_categoria' WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "select su.id, su.subcategoria, su.id_categoria, cat.categoria
from subcategoria su
inner join categoria cat on su.id_categoria = cat.id WHERE su.id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break; 
        
    case 3://baja
        $consulta = "DELETE FROM categoria WHERE id='$id' ";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        
         $consulta = "select su.id, su.subcategoria, su.id_categoria, cat.categoria
from subcategoria su
inner join categoria cat on su.id_categoria = cat.id WHERE su.id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;