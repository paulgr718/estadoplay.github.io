<?php
include_once '../conexion/cls_conexion.php';

/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
// Recepción de los datos enviados mediante POST desde el JS   
$estado = 'a';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$id_subcategoria = (isset($_POST['id_subcategoria'])) ? $_POST['id_subcategoria'] : '';
$precio_unitario = (isset($_POST['precio_unitario'])) ? $_POST['precio_unitario'] : '';
$stock= (isset($_POST['stock'])) ? $_POST['stock'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$codigo = (isset($_POST['codigo'])) ? $_POST['codigo'] : '';

switch($opcion){
    case 1: //alta

		 $consulta = "INSERT INTO productos (nombre, descripcion, precio_unitario, stock, id_subcategoria) VALUES('$nombre','$descripcion','$precio_unitario','$stock','$id_subcategoria') ";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT pr.codigo, pr.nombre, pr.descripcion, cat.categoria, su.subcategoria,
 pr.precio_unitario, pr.stock, pr.id_subcategoria
 from productos pr
 inner join subcategoria su on pr.id_subcategoria = su.id
 inner join categoria cat on su.id_categoria = cat.id
ORDER BY pr.codigo DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        
       
        break;
    case 2: //modificación
        $consulta = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio_unitario='$precio_unitario', stock='$stock', id_subcategoria='$id_subcategoria'
        WHERE codigo='$codigo'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT pr.codigo, pr.nombre, pr.descripcion, cat.categoria, su.subcategoria,
 pr.precio_unitario, pr.stock, pr.id_subcategoria
 from productos pr
 inner join subcategoria su on pr.id_subcategoria = su.id
 inner join categoria cat on su.id_categoria = cat.id WHERE su.codigo='$codigo' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM productos WHERE codigo='$codigo' ";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        
         $consulta = "SELECT pr.codigo, pr.nombre, pr.descripcion, cat.categoria, su.subcategoria,
 pr.precio_unitario, pr.stock, pr.id_subcategoria
 from productos pr
 inner join subcategoria su on pr.id_subcategoria = su.id
 inner join categoria cat on su.id_categoria = cat.id WHERE su.id='$codigo' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;