<?php
include_once "../../conexion/cls_conexion.php";
?>
<?php
if (isset($_POST["acceso"])) {
  if (!empty($_POST["usuario"]) || !empty($_POST["clave"])) {
    $user = $_POST["usuario"];
    $pass = $_POST["clave"];

    //buscar usuario
    $query = "SELECT * FROM propietario WHERE usuario = :usuario AND clave = :clave";
    $consulta = $conexion->prepare($query);

    $consulta->bindParam(":usuario", $user);
    $consulta->bindParam(":clave", $pass);
    $consulta->execute();

    //existencia de usuario

    $cont = $consulta->rowCount();
    if ($cont > 0) {
      $datos = $consulta->fetch();
      @session_start();
      $_SESSION["usuario"] = $datos;
      $_SESSION["acceso"] = true;
      header("location:../../view/dashboard/dashboard.php");
    } else {
      $message = '<label>Usuario y/o contraseña son incorrectos</label>';
    }
  } else {
    $message = '<label>Asegure llenar los campos</label>';
  }
}
?>
<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css_lg/icomoon/style.css">

    <link rel="stylesheet" href="css_lg/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../dashboard/bootstrap/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css_lg/estilo.css">

    <link rel="stylesheet" href="css_lg/wave.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../view/style/estilo_login.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <title>Login</title>
      <link rel="icon" href="../../img/icon_web.png">

  </head>

  <body>


    <img src="../../img/wave.png" class="ondas">

    <div class="container">
      <div class="content">

        <div class="row">
          <div class="col-md-6">
            <img src="../../img/img_log.png" class="img-fluid">
          </div>
          <div class="col-md-6 contents">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="mb-4">
                  <?php
                  if (isset($message)) {
                    echo '<label class="text-danger">' . $message . '</label>';
                  }
                  ?>
                  <center>
                    <h1><strong>Iniciar Sesion</strong></h1>
                  </center>
                  <!--<p class="mb-4">No olvides ingresar los datos correctamente.</p>-->
                </div>
                <form action="#" method="post">
                  <div class="form-group first">



                    <label for="usuario"><i class="fas fa-user"></i> Usuario</label>
                    <input type="text" class="form-control" name="usuario" maxlength="14" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                  </div>
                  <div class="form-group last mb-4">
                    <label for="clave"><i class="fas fa-lock"></i> contraseña</label>
                     
                    <input type="password" class="form-control" name="clave" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                  </div>

                  <div class="d-flex mb-5 align-items-center">
                    <label class="control control--checkbox mb-0"><span class="caption">Recordamelo</span>
                      <input type="checkbox" checked="checked" />
                      <div class="control__indicator"></div>
                    </label>
                    <!--<span class="ml-auto"><a href="#" class="forgot-pass">¿Olvide mi contraseña?</a></span>-->
                  </div>

                  <input type="submit" value="Acceder" name="acceso" class="btn btn-block btn-primary">


                </form>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>


    <script src="js_lg/jquery-3.3.1.min.js"></script>
    <script src="js_lg/popper.min.js"></script>
    <script src="js_lg/bootstrap.min.js"></script>
    <script src="js_lg/main.js"></script>
  </body>

</html>