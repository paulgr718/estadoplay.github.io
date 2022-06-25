<?php
include_once '../conexion/cls_conexion.php';

/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
// Recepción de los datos enviados mediante POST desde el JS   
$estado = 'a';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta

       /* $consulta = "SELECT id, categoria FROM categoria ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);;*/
	
        
       
        break;
    case 2: //modificación
      
        $consulta = "select dt.detalle, dt.valor_unitario
        from  deuda de
        inner join detalle_deuda dt on de.id= dt.id_deuda WHERE dt.id_deuda='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
   
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
