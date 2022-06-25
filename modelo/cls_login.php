<?php
/*include_once '../../conexion/cls_conexion.php';
class cls_login extends cls_conexion{
    
    private $nombre;
    private $usuario;
    
    public function userExists($usuario, $clave){
        $md5pass = md5($clave);
        
        $consulta = "SELECT * FROM propietario WHERE usuario = :usuario AND clave=:clave;";
$resultado = $conexion->prepare($consulta);
$resultado->execute(['usuario' => $usuario, 'clave' => $md5pass]);
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
        if(data->rowCount()){
            return true;
        }else {
            return false;
        }
    }
    public function setUser($usuario){
        $consulta = "SELECT * FROM propietario WHERE usuario = :usuario;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(['usuario' => $usuario]);
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $currentUser){
            
            $this->nombre = $currentUser['nombre'];
            $this->usuario = $currentUser['usuario'];
        }
    }
    public function getNombre(){
        return $this->nombre;
    }
}*/
?>