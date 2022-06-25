<?php 
include_once '../../conexion/cls_conexion.php';

/**
 * 
 */
class cls_usuario
{
	public $id_propietario;
	public $nombre;
	public $apellido;
	public $correo;
    public $telefono;
	public $usuario;
	public $clave;
	//funcion para almacenar registros
	
	public function actualizar(){
        $query = "update propietario set nombre=:nombre,apellido=:apellido,correo=:correo,telefono=:telefono, usuario=:usuario, clave=:clave 
where id_propietario=:id_propietario";  
                $consulta = $conexion->prepare($query);  

		$consulta->bindParam(":nombre", $this->nombre,PDO::PARAM_STR);
		$consulta->bindParam(":apellido", $this->apellido,PDO::PARAM_STR);
		$consulta->bindParam(":correo", $this->correo,PDO::PARAM_STR);
		$consulta->bindParam(":telefono", $this->telefono,PDO::PARAM_STR);
		$consulta->bindParam(":usuario", $this->usuario,PDO::PARAM_STR);
        $consulta->bindParam(":clave", $this->clave,PDO::PARAM_STR);
		$consulta->bindParam(":id_propietario", $this->id_propietario,PDO::PARAM_INT);
		return $consulta->execute();
		$consulta->close();

	}	

	}
?>
