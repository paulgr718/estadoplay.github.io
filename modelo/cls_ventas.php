<?php
include_once '../conexion/cls_conexion.php';

/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
// Recepción de los datos enviados mediante POST desde el JS   
$estado = 'a';
$id_cliente = (isset($_POST['id_cliente'])) ? $_POST['id_cliente'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$cod = (isset($_POST['cod'])) ? $_POST['cod'] : '';
$canti = (isset($_POST['canti'])) ? $_POST['canti'] : '';
$id_compra = (isset($_POST['id_compra'])) ? $_POST['id_compra'] : '';

switch ($tipo) {
    case 0: //alta
        $consulta = "insert into compra (id_cliente, precio_total, fecha) VALUES($id_cliente, '$precio', curdate()) ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 1:
        $consulta = "select id_compra from compra order by id_compra desc limit 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchColumn();

        $consulta = "INSERT INTO detalle(codigo_producto, cantidad, id_compra) VALUES ($cod,$canti,(select id_compra from compra order by id_compra desc limit 1)) ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "DELETE FROM compra WHERE id_compra=".$id_compra;
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "DELETE FROM compra WHERE id_compra=".$id_compra;
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}
$conexion = NULL;
print json_encode($consulta, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS