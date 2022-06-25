<?php 
    require_once "../dashboard/view_dash/superior.php";
?>
<?php 
include_once '../../conexion/cls_conexion.php';
//include_once "../../controlador/ctl_usuario.php" 
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
   <script type="text/javascript">
		function alerta(){
 swal({

   title: "¡AVISO!",
   text: "Se modificaron sus datos con exito",
   type: "success",
 });
}

	</script>
<div class="container-fluid">


                    <div class="card shadow mb-4">
                        <div class="card-body">
                              <div class="content">
 
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          

          <div class="row justify-content-center">
            <div class="col-md-6">
              
              <h3 class="heading mb-4">Configuracion del perfil</h3>
              <p>No olvides poner una contraseña que la recuerdes facilmente</p>

            <img src="../../img/registro.svg" alt="Image" class="img-fluid">


            </div>
            <div class="col-md-6"><br>
              
              <form class="mb-5" method="post" id="contactForm" name="contactForm" action="#">
                <div class="row">
                    <input type="hidden" name="id_propietario" value="<?php echo ucwords($_SESSION['usuario']['id_propietario'])?>">
                  <div class="col-md-12 form-group">
                      
                    <input type="text" class="form-control" name="nombre"  placeholder="Nombre" value="<?php echo ucwords($_SESSION['usuario']['nombre'])?>" readonly>
                  </div>
                </div>
                  <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="apellido"  placeholder="Apellido" value="<?php echo ucwords($_SESSION['usuario']['apellido'])?>" readonly>
                  </div>
                </div>
                  <div class="row">
                  <div class="col-md-12 form-group">
                      
                    <input type="text" class="form-control" name="correo"  placeholder="E-mail" value="<?php echo ucwords($_SESSION['usuario']['correo'])?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="telefono"  placeholder="Telefono" value="<?php echo ucwords($_SESSION['usuario']['telefono'])?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="usuario"  placeholder="Usuario" value="<?php echo ucwords($_SESSION['usuario']['usuario'])?>" required>
                  </div>
                </div>
                   <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="password" class="form-control" name="clave" id="clave" placeholder="Ingrese la nueva contraseña" required>
                  </div>
                </div>  
                  <input type="checkbox" onclick="funcion_2()"> Mostrar contraseña
                                    <script type="text/javascript">
 	                  function funcion_2() {
 		                 var pass = document.getElementById("clave");
 		                 if (pass.type==="password") {
 			                    pass.type="text";
 		                 }else{
 			                pass.type="password"
 		                 }

 	                  }
                    </script>                
                <div class="row">
                  <div class="col-12"><br>
                    <input name="enviar" type="submit" value="Guardar" class="btn btn-dark" style="circle-round:25dp">
                  <span class="submitting"></span>
                  </div>
                    <?php 
                                if (isset($_POST['enviar'])) {
                                $id = $_POST['id_propietario'];
                                $a = $_POST['nombre'];
                                 $b = $_POST['apellido'];
                                 $c = $_POST['correo'];
                                    $d = $_POST['telefono'];
                                    $e = $_POST['usuario'];
                                    $f = $_POST['clave'];
                                 $sql = "update propietario set nombre=:nombre,apellido=:apellido,correo=:correo,telefono=:telefono, usuario=:usuario, clave=:clave 
                                where id_propietario='$id';";
                                 $sentencia =$conexion->prepare($sql);
                                 $sentencia->bindParam(':nombre', $a);
                                 $sentencia->bindParam(':apellido', $b);
                                  $sentencia->bindParam(':correo', $c);
                                    $sentencia->bindParam(':telefono', $d);
                                    $sentencia->bindParam(':usuario', $e);
                                    $sentencia->bindParam(':clave', $f);

                                  $sentencia->execute();
                                  echo "<script type='text/javascript'> alerta();
                                </script>";
                                }
                                ?>
                                    </div>
                                  </form>


                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                </div>
            </div>
<?php 
    require_once "../dashboard/view_dash/inferior.php";
?>