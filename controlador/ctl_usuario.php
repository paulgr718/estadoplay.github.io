<?php
//include_once llamar la otra pagina el codigo...
include_once "../../modelo/cls_usuario.php";
$resultado="";
$id_propietario="";
$nombre="";
$apellido="";
$correo="";
$telefono="";
$usuario="";
$clave="";


if (isset($_POST["btnactualizar"])) {
	$objusuario= new cls_usuario();
	$nombre=trim($_POST["nombre"]);
	$apellido=trim($_POST["apellido"]);
	$correo=trim($_POST["correo"]);
    $telefono=trim($_POST["telefono"]);
	$usuario=trim($_POST["usuario"]);
	$password=trim($_POST["clave"]);
	$id_propietario=trim($_POST["id_propietario"]);
	$objusuario->id_propietario=$id_propietario;
	$objusuario->nombre=$nombre;
	$objusuario->apellido=$apellido;
	$objusuario->correo=$correo;
    $objusuario->telefono=$telefono;
	$objusuario->usuario=$usuario;
	$objusuario->clave=$clave;
	$valor=$objusuario->actualizar();

	if ($valor==true) {
		$resultado= "<div class='alert alert-info'> Se actualizado correctamente";
	}else {
		$resultado="<div class='alert alert-danger'> No se logro actualizar los datos";
	}
}

?>