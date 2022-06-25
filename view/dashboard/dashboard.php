<?php
require_once "view_dash/superior.php";
?>

<?php
include_once "../../conexion/cls_conexion.php";
/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
//include_once "../../controlador/ctl_lista_dispositivo.php";

?>
<?php
$consulta = "select dp.id, dp.num_equipo,tp.nombre, dp.precio_uso, estado_c
from dispositivos dp
inner join tipo tp on dp.id_tipo = tp.id";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);


?>
<!-- inicio de contenido principal -->

<div class="container">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Ganancias (Hoy)</div>
                            <?php
                            $consulta2 = "select sum(precio) from
        (select pr.precio_unitario*dt.cantidad as precio, EXTRACT(MONTH FROM co.fecha), EXTRACT(DAY FROM co.fecha),
        EXTRACT(YEAR FROM co.fecha) from detalle dt
                                                        INNER join productos pr on dt.codigo_producto = pr.codigo
                                                        inner join compra co on dt.id_compra = co.id_compra
        where EXTRACT(DAY FROM co.fecha)=(SELECT EXTRACT(DAY FROM DATE(NOW()))) and EXTRACT(MONTH FROM co.fecha)=(SELECT EXTRACT(MONTH FROM DATE(NOW())))
        and EXTRACT(YEAR FROM co.fecha)=(SELECT EXTRACT(YEAR FROM DATE(NOW())))) as y";
                            $resultado2 = $conexion->prepare($consulta2);
                            $resultado2->execute();
                            $data8 = $resultado2->fetchColumn();

                            ?>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php $data8 == null ? print '00.00' : print ' ' . $data8; ?></div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>

                    </div>
                </div>

                <a style="color:#0081F5; cursor:pointer" data-toggle="modal" data-target="#modalgh">&nbsp&nbsp&nbsp Mostrar información</a>


                <!-- Modal -->

                <div class="modal fade" id="modalgh" tabindex="-1" role="dialog" aria-labelledby="gananciasHoy" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="gananciasHoy">Ganancias de hoy <span id="fechamodal">dd/mm/aa</span></h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $consulta2 = "select CONCAT(pr.nombre, ' ', pr.descripcion) As producto, dt.cantidad, pr.precio_unitario*dt.cantidad as precio_total, co.fecha
                                    from detalle dt
                                    INNER join productos pr on dt.codigo_producto = pr.codigo
                                    inner join compra co on dt.id_compra = co.id_compra 
                                             where co.fecha = curdate()";
                                $resultado2 = $conexion->prepare($consulta2);
                                $resultado2->execute();
                                $data10 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

                                ?>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="table-responsive">
                                                <table id="tablaGH" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                                                    <thead class="text-center" style="background-color:#007EFA; color:#ffffff">
                                                        <tr>

                                                            <th>Producto</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio total</th>
                                                            <th>Fecha</th>
                                                            
                                                            <!--<th>Accion</th>-->

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($data10 as $dat) {
                                                        ?>
                                                            <tr>

                                                                <td><?php echo $dat['producto'] ?></td>
                                                                <td><center><?php echo $dat['cantidad'] ?></center></td>
                                                                <td><center>$ <?php echo $dat['precio_total'] ?></center></td>
                                                                <td><?php echo $dat['fecha'] ?></td>
                                                                

                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ganancias (Mensual)</div>

                            <?php
                            $consulta2 = "select sum(precio) from
                                                        (select pr.precio_unitario*dt.cantidad as precio, EXTRACT(MONTH FROM co.fecha), EXTRACT(YEAR FROM co.fecha) from detalle dt
                                                        INNER join productos pr on dt.codigo_producto = pr.codigo
                                                        inner join compra co on dt.id_compra = co.id_compra
                                                        where EXTRACT(MONTH FROM co.fecha)=(SELECT EXTRACT(MONTH FROM DATE(NOW())))
                                                        and EXTRACT(YEAR FROM co.fecha)=(SELECT EXTRACT(YEAR FROM DATE(NOW())))) as X";
                            $resultado2 = $conexion->prepare($consulta2);
                            $resultado2->execute();
                            $data9 = $resultado2->fetchColumn();

                            ?>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php $data9 == null ? print '00.00' : print ' ' . $data9; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a style="color:#00C289; cursor:pointer" data-toggle="modal" data-target="#modalgy">&nbsp&nbsp&nbsp Mostrar información</a>
                <div class="modal fade" id="modalgy" tabindex="-1" role="dialog" aria-labelledby="modalGaMe" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalGaMe">Ganancias del mes <span id="fechamodalmensual">dd/mm/aa</span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $consulta2 = "select CONCAT(pr.nombre, ' ', pr.descripcion) As producto, dt.cantidad, pr.precio_unitario*dt.cantidad as precio_total, co.fecha
                                from detalle dt
                                INNER join productos pr on dt.codigo_producto = pr.codigo
                                inner join compra co on dt.id_compra = co.id_compra 
                                where EXTRACT(MONTH FROM co.fecha)=(SELECT EXTRACT(MONTH FROM DATE(NOW()))) and EXTRACT(YEAR FROM co.fecha)=(SELECT EXTRACT(YEAR FROM DATE(NOW())))";
                                $resultado2 = $conexion->prepare($consulta2);
                                $resultado2->execute();
                                $data11 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

                                ?>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="table-responsive">
                                                <table id="tablaGM" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                                                    <thead class="text-center" style="background-color:#007EFA; color:#ffffff">
                                                        <tr>

                                                            <th>Producto</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio total</th>
                                                            <th>Fecha</th>
                                                            
                                                            <!--<th>Accion</th>-->

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($data11 as $dat) {
                                                        ?>
                                                            <tr>

                                                                <td><?php echo $dat['producto'] ?></td>
                                                                <td><center><?php echo $dat['cantidad'] ?></center></td>
                                                                <td><center>$ <?php echo $dat['precio_total'] ?></center></td>
                                                                <td><?php echo $dat['fecha'] ?></td>
                                                                
                                                                

                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            var f = new Date();
            var dia = f.getDate();
            var mes = meses[f.getMonth()];
            var anio = f.getFullYear();
            var year = f.getFullYear();

            /*document.getElementById("fecha").innerHTML = (f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());*/
            document.getElementById("fechamodal").innerHTML = "( " + dia + " de " + mes + " del " + year + " )";
            document.getElementById("fechamodalmensual").innerHTML = " de " + mes + " del " + year;
        </script>

        <!-- Tasks Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Actividad
                            </div>
                            <div class="row no-gutters align-items-center">
                                <?php
                                $consulta2 = "select count(*) as cant from dispositivos";
                                $resultado2 = $conexion->prepare($consulta2);
                                $resultado2->execute();
                                $data2 = $resultado2->fetchColumn();

                                ?>
                                <div class="col-auto">
                                    <div class=" mb-0 mr-3 font-weight-bold text-gray-800">Total:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-gray-400" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php print $data2; ?></div>
                                    </div>
                                </div>
                                <br>

                            </div>
                            <div class="row no-gutters align-items-center">
                                <?php
                                $consulta2 = "select count(*) as cant from dispositivos where estado_c='disponible'";
                                $resultado2 = $conexion->prepare($consulta2);
                                $resultado2->execute();
                                $data3 = $resultado2->fetchColumn();

                                ?>
                                <div class="col-auto">
                                    <div class=" mb-0 mr-3 font-weight-bold text-gray-800">Disponible:</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php print $data3; ?></div>
                                    </div>
                                </div>


                            </div>
                            <div class="row no-gutters align-items-center">
                                <?php
                                $consulta2 = "select count(*) as cant from dispositivos where estado_c='ocupado'";
                                $resultado2 = $conexion->prepare($consulta2);
                                $resultado2->execute();
                                $data4 = $resultado2->fetchColumn();

                                ?>
                                <div class="col-auto">
                                    <div class="mb-0 mr-3 font-weight-bold text-gray-800">Ocupado:&nbsp&nbsp&nbsp</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php print $data4; ?></div>
                                    </div>
                                </div>
                                <br>

                            </div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <?php
            $consulta2 = "select count(*) as cant from deuda where estado='pendiente';";
            $resultado2 = $conexion->prepare($consulta2);
            $resultado2->execute();
            $data5 = $resultado2->fetchColumn();

            ?>
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                deudas pendientes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php print $data5 . " deudas"; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a style="color:#FFC04F; cursor:pointer" data-toggle="modal" data-target="#modaldepe">&nbsp&nbsp&nbsp Mostrar información</a>
                <div class="modal fade" id="modaldepe" tabindex="-1" role="dialog" aria-labelledby="deudas" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deudas">Deudas pendientes</h5>



                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">



                                <?php
                                $consulta = "select *
                                                    from cliente cli
                                                    inner join deuda de on de.id_cliente = cli.id_cliente
                                                    where de.estado = 'pendiente';'";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $data6 = $resultado->fetchAll(PDO::FETCH_ASSOC);


                                ?>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table id="tabladt" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                                                    <thead class="text-center" style="background-color:#007EFA; color:#ffffff">
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Cliente</th>
                                                            <th>Fecha de emision</th>
                                                            <th>Total deuda</th>
                                                            <!--<th>Accion</th>-->

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($data6 as $dat) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $dat['id'] ?></td>
                                                                <td><?php echo $dat['nombre'] ?></td>
                                                                <td><?php echo $dat['fecha'] ?></td>
                                                                <td><?php echo $dat['valor_deuda'] ?></td>
                                                                <!--<td>
                                                                    <div class='text-center'>
                                                                        <div class='btn-group'><button class='btn btn-success' href="#btnPagar" data-toggle="modal">Pagar</button><button class='btn btn-warning ' href="#btnDetalles" data-toggle="modal" id="btnDeta">Detalle</button></div>
                                                                    </div>
                                                                </td>-->
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>


                                                    </tbody>
                                                </table>
                                                <script>
                                                    var id = 1;
                                                    var fila; //capturar la fila para editar o borrar el registro


                                                    $(document).on("click", "#btnDeta", function() {
                                                            fila = $(this).closest("tr");
                                                            id = parseInt(fila.find('td:eq(0)').text());
                                                            if (window.history.replaceState) {
                                                                window.history.replaceState("", "", "dashboard.php" + "?deuda=" + id);
                                                            }
                                                            $("#asdf").load(" #asdf");
                                                        }

                                                    );
                                                </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">


                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="btnDetalles" tabindex="-1" role="dialog" aria-labelledby="deudas" aria-hidden="true">
                    <div class="modal-dialog modal-lg" id="asdf" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deudas">Detalle de la deuda</h5>
                                <?php
                                if (isset($_GET["deuda"])) {
                                    $phpVar1 = $_GET["deuda"];
                                } else {
                                    $phpVar1 = 0;
                                }
                                ?>
                                <?php
                                $consulta = "select dt.detalle, dt.valor_unitario
                                                        from  deuda de
                                                        inner join detalle_deuda dt on de.id= dt.id_deuda WHERE dt.id_deuda=.$phpVar1";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $data7 = $resultado->fetchAll(PDO::FETCH_ASSOC);


                                ?>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php
                                            $var_PHP = "<script> localStorage.setItem(id); </script>"; // igualar el valor de la variable JavaScript a PHP 

                                            echo $var_PHP   // muestra el resultado 

                                            ?>
                                            <div class="table-responsive">
                                                <table id="tabladtde" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                                                    <thead class="text-center" style="background-color:#007EFA; color:#ffffff">
                                                        <tr>

                                                            <th>Detalle</th>
                                                            <th>valor Unitario</th>



                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($data7 as $dat) {
                                                        ?>
                                                            <tr>

                                                                <td><?php echo $dat['detalle'] ?></td>
                                                                <td><?php echo $dat['valor_unitario'] ?></td>

                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">

            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                    <center>
                        <h6 class="m-0 font-weight-bold text-primary"> Actividad de dispositivos</h6>
                    </center>

                </div>
                <!-- temporizador -->
                <!-- <p><span class='break-timer'>00:00</span></p>
            <form>
                <input type='number' value='30' id='length2'>
                <label for='length2'></label>
            </form>
                                
            <p class='stack-sm'>
                <button class='start-break'>iniciar</button>
                <button class='cancel-break'>parar</button>
            </p>-->




                <div class="card-body">


                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="table-responsive">

                                    <table id="tablaCd" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                                        <thead class="text-center" style="background-color:#007EFA; color:#ffffff">
                                            <tr>
                                                <th>ID</th>
                                                <th>Numero</th>
                                                <th>Dispositivo</th>
                                                <th>Tiempo</th>
                                                <th>Total pago</th>
                                                <th>Estado</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $contador = 1;
                                            foreach ($data as $dat) {
                                            ?>
                                                <tr>

                                                    <td><?php echo $dat['id'] ?></td>
                                                    <td><?php echo $dat['num_equipo'] ?></td>
                                                    <td><?php echo $dat['nombre'] ?></td>
                                                    <input type="hidden" id="id_<?php echo $contador; ?>" value="<?php echo $dat['id']; ?>">
                                                    <input type="hidden" id="num_equipo_<?php echo $contador; ?>" value="<?php echo $dat['num_equipo']; ?>">
                                                    <input type="hidden" id="nombre_<?php echo $contador; ?>" value="<?php echo $dat['nombre']; ?>">
                                                    <td>
                                                        <center>
                                                            <p id="temp_<?php echo $dat['id']; ?>">00:00:00</p>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                           
                                                            <p id="pago_<?php echo $dat['id']; ?>">$ <?php echo $dat['precio_uso']; ?></p>
                                                        </center>
                                                    </td>
                                                    <?php
                                                    if ($dat['estado_c'] == "disponible") { ?>
                                                    <td><span class="badge bg-success text-white"><?php echo $dat['estado_c'] ?></span></td>
                                                        <td>
                                                            <div class='text-center'>
                                                                <div class='btn-group'><button type="button" onclick="agarrar(document.getElementById('id_<?php echo $contador; ?>').value,document.getElementById('num_equipo_<?php echo $contador; ?>').value,document.getElementById('nombre_<?php echo $contador; ?>').value)" class='btn btn-primary' class="boton" id="btnAlq" data-toggle="modal">Alquilar</button></div>
                                                            </div>
                                                        </td>

                                                        <script>
                                                            var id_temp = "";
                                                            var id_fila = "";

                                                            function agarrar(id, num_maq, disp) {
                                                                $('#btnAlquilar').modal('show');
                                                                var Myelement = document.getElementById("num_maquina");
                                                                Myelement.value = num_maq;
                                                                var Myelement = document.getElementById("dispo");
                                                                Myelement.value = disp;
                                                                id_temp = "#temp_" + id;
                                                                id_fila = id;
                                                            }
                                                        </script>

                                                        <div class="modal fade" id="btnAlquilar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary" style="background-color:#DCDFEA">
                                                                        <h5 class="modal-title text-white" id="exampleModalLabel" >Control de maquina</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form id="formCd" action="#" method="post">
                                                                        <div class="modal-body">

                                                                            <div class="form-group">
                                                                                <label for="serie" class="col-form-label">Numero de maquina:</label>
                                                                                <input type="Text" value="" class="form-control" id="num_maquina">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="serie" class="col-form-label">Dispositivo:</label>
                                                                                <input type="Text" class="form-control" id="dispo">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="serie" class="col-form-label">Tiempo:</label>

                                                                                <div class="row justify-content-between">

                                                                                    <div class="col-md-4">
                                                                                        <label for="hor" class="col-form-label" style="color:#848795">hora:</label>
                                                                                        <input class="form-control" type="number" id="h<?php echo $dat['id']; ?>" value="0" min="0" max="60">
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <label for="min" class="col-form-label" style="color:#848795">Minutos:</label>
                                                                                        <input class="form-control" type="number" value="0" min="0" max="60" id="m<?php echo $dat['id']; ?>">
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <label for="sg" class="col-form-label" style="color:#848795">Segundos:</label>
                                                                                        <input class="form-control" type="number" min="0" max="60" value="0" id="s<?php echo $dat['id']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">

                                                                                    <input type="checkbox" checked> <label for="serie" class="col-form-label" style="color:#848795">&nbsp Tiempo libre</label>
                                                                                </div>

                                                                            </div>



                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                                                            <button data-dismiss="modal" type="button" class="btn btn-dark" onclick="empezar(document.getElementById('h<?php echo $dat['id']; ?>').value,document.getElementById('m<?php echo $dat['id']; ?>').value,document.getElementById('s<?php echo $dat['id']; ?>').value, id_fila)">Empezar</button>

                                                                        </div>
                                                                        <script>
                                                                            function alerta(tempo) {

                                                                                swal({
                                                                                        title: "¡AVISO!",
                                                                                        text: "Se termino el tiempo del dispositivo con ID: " + tempo,
                                                                                        type: "warning",

                                                                                        confirmButtonText: "Entendido",

                                                                                    })
                                                                                    .then(resultado => {
                                                                                        if (resultado.value) {
                                                                                            window.location.reload();
                                                                                            audio.pause();
                                                                                        } else {
                                                                                            // Dijeron que no
                                                                                            window.location.reload();
                                                                                            audio.pause();
                                                                                        }
                                                                                    });
                                                                            }


                                                                            var timer;
                                                                            audio = new Audio("sonido/alarma.mp3");
                                                                            //se pregunta si tiene hora de finalizacion el cronometro, 
                                                                            //si los valores tienen datos se asigna en una variable date para posteriomente ser restados con la hora actual
                                                                            if (localStorage.getItem("hem_<?php echo $dat['id']; ?>") != null) {
                                                                                let ddd = new Date();
                                                                                let dddd=localStorage.getItem("hp_<?php echo $dat['id']; ?>");
                                                                                if (moment(ddd).isSameOrAfter(dddd)==true) {
                                                                                    localStorage.removeItem("hora_<?php echo $dat['id']; ?>");
                                                                                    localStorage.removeItem("minuto_<?php echo $dat['id']; ?>");
                                                                                    localStorage.removeItem("segundos_<?php echo $dat['id']; ?>");
                                                                                    localStorage.removeItem("hem_<?php echo $dat['id']; ?>");
                                                                                    localStorage.removeItem("hp_<?php echo $dat['id']; ?>");
                                                                                    localStorage.removeItem("tt_<?php echo $dat['id']; ?>");
                                                                                    alerta(<?php echo $dat['id']; ?>);
                                                                                }
                                                                            }

                                                                            if (localStorage.getItem("hora_<?php echo $dat['id']; ?>") != null && localStorage.getItem("minuto_<?php echo $dat['id']; ?>") != null && localStorage.getItem("segundos_<?php echo $dat['id']; ?>") != null) {
                                                                                //asigna la hora que termina el temporizador
                                                                                let date = new Date();
                                                                                date.setHours(localStorage.getItem("hora_<?php echo $dat['id']; ?>"));
                                                                                date.setMinutes(localStorage.getItem("minuto_<?php echo $dat['id']; ?>"));
                                                                                date.setSeconds(localStorage.getItem("segundos_<?php echo $dat['id']; ?>"));
                                                                                //resta las horas final-actual y envia a que se ejecute el timer
                                                                                let date2 = new Date();
                                                                                var asd = moment(date).subtract(date2.getHours(), 'hours').subtract(date2.getMinutes(), 'minutes').subtract(date2.getSeconds(), 'seconds').format('HH:mm:ss');
                                                                                var as = asd.split(":");
                                                                                let date3 = localStorage.getItem("tt_<?php echo $dat['id']; ?>");
                                                                                var mm = moment(date3);
                                                                                console.log(date3);
                                                                                var pr = document.getElementById("pago_<?php echo $dat['id']; ?>").textContent;
                                                                                pr = pr.split("$");
                                                                                pr = pr[1].trim();
                                                                                console.log(pr);
                                                                                var pagar = moment.duration(mm.format("HH:mm")).asMinutes() * (pr / 30);
                                                                                var Myelement = document.getElementById("pago_<?php echo $dat['id']; ?>");
                                                                                Myelement.textContent = "$ " + parseFloat(pagar).toPrecision(2) + "0";
                                                                                empezar(as[0], as[1], as[2], "<?php echo $dat['id']; ?>");
                                                                            }




                                                                            function empezar(h, m, s, tempo) {
                                                                                audio.pause();
                                                                                audio.currentTime = 0;



                                                                                $("#temp_" + tempo).timer('remove');
                                                                                let date2 = new Date();
                                                                                //toma hora inicial uy la guarda en la localStorage
                                                                                if (localStorage.getItem("hora_" + tempo) == null && localStorage.getItem("minuto_" + tempo) == null && localStorage.getItem("segundos_" + tempo) == null) {
                                                                                    //toma hora actual
                                                                                    let date = new Date();
                                                                                    //asigna el tiempo que se ingreso en los inputs

                                                                                    date2.setHours(parseInt(h));
                                                                                    date2.setMinutes(parseInt(m));
                                                                                    date2.setSeconds(parseInt(s));
                                                                                    localStorage.setItem("tt_" + tempo, date2);
                                                                                    //crea y guarda la hora final del temporizador
                                                                                    var asd = moment(date).add(date2.getHours(), 'hours').add(date2.getMinutes(), 'minutes').add(date2.getSeconds(), 'seconds').format('HH:mm:ss');
                                                                                    var as = asd.split(":");

                                                                                    date2.setHours(parseInt(as[0]));
                                                                                    date2.setMinutes(parseInt(as[1]));
                                                                                    date2.setSeconds(parseInt(as[2]));

                                                                                    localStorage.setItem("hp_" + tempo, date2);
                                                                                    localStorage.setItem("hem_" + tempo, date)
                                                                                    localStorage.setItem("hora_" + tempo, as[0]);
                                                                                    localStorage.setItem("minuto_" + tempo, as[1]);
                                                                                    localStorage.setItem("segundos_" + tempo, as[2]);
                                                                                    var mm = moment(localStorage.getItem("tt_"+ tempo));
                                                                                    var pr = document.getElementById("pago_" + tempo).textContent;
                                                                                    pr = pr.split("$");
                                                                                    pr = pr[1].trim();
                                                                                    var pagar = moment.duration(mm.format("HH:mm")).asMinutes() * (pr / 30);
                                                                                    var Myelement = document.getElementById("pago_" + tempo);
                                                                                    Myelement.textContent = "$ " + parseFloat(pagar).toPrecision(2) + "0";
                                                                                }

                                                                                $("#temp_" + tempo).timer({
                                                                                    countdown: true,
                                                                                    duration: parseInt(h) + "h" + parseInt(m) + "m" + parseInt(s) + 's',
                                                                                    callback: function() {
                                                                                        audio.addEventListener('ended', function() {
                                                                                            this.currentTime = 0;
                                                                                            localStorage.removeItem("hora_" + tempo);
                                                                                            localStorage.removeItem("minuto_" + tempo);
                                                                                            localStorage.removeItem("segundos_" + tempo);
                                                                                            localStorage.removeItem("hp" + tempo);
                                                                                            localStorage.removeItem("hem_" + tempo);
                                                                                            localStorage.removeItem("tt_" + tempo);
                                                                                            this.play();


                                                                                        }, false);
                                                                                        audio.play();

                                                                                        localStorage.removeItem("hora_" + tempo);
                                                                                        localStorage.removeItem("minuto_" + tempo);
                                                                                        localStorage.removeItem("segundos_" + tempo);
                                                                                        localStorage.removeItem("hp_" + tempo);
                                                                                        localStorage.removeItem("tt_" + tempo);
                                                                                        localStorage.removeItem("hem_" + tempo);
                                                                                        setTimeout(alerta(tempo), 3000);
                                                                                    },
                                                                                    format: '%H:%M:%S'
                                                                                });

                                                                            }
                                                                        </script>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    <?php

                                                    } else {
                                                    ?>
                                                    <td><span class="badge bg-danger text-white"><?php echo $dat['estado_c'] ?></span></td>
                                                        <td>
                                                            <div class='text-center'>
                                                                <div class='btn-group'><button class='btn btn-warning' href="#btnEditar" data-toggle="modal">Editar</button><button class='btn btn-danger' href="#btnPagar" data-toggle="modal">Cobrar</button></div>
                                                            </div>
                                                        </td>

                                                        <div class="modal fade" id="btnEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color:#FFBF35">
                                                                        <h5 class="modal-title" id="exampleModalLabel" style="color:#010B15">Control de maquina</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form id="formCat">
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="serie" class="col-form-label">Numero de maquina:</label>
                                                                                <input type="Text" class="form-control" id="categoria">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="serie" class="col-form-label">Dispositivo:</label>
                                                                                <input type="Text" class="form-control" id="categoria">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="serie" class="col-form-label">Tiempo:</label>

                                                                                <div class="row justify-content-between">

                                                                                    <div class="col-md-4">
                                                                                        <label for="hor" class="col-form-label" style="color:#848795">hora:</label>
                                                                                        <input class="form-control" type="number" id="h" value="0" min="0" max="60">
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <label for="min" class="col-form-label" style="color:#848795">Minutos:</label>
                                                                                        <input class="form-control" type="number" value="30" min="0" max="60" id="m">
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <label for="sg" class="col-form-label" style="color:#848795">Segundos:</label>
                                                                                        <input class="form-control" type="number" min="0" max="60" value="0" id="s">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">

                                                                                    <input type="checkbox"> <label for="serie" class="col-form-label" style="color:#848795">&nbsp Tiempo libre</label>
                                                                                </div>

                                                                            </div>



                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" id="btnGuardar" class="btn btn-dark">Editar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php  } ?>


                                                </tr>
                                            <?php
                                                $contador = $contador + 1;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Card Example
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div> -->

        </div>



    </div>

</div>
<!--
<script>
    const startBBtn = document.querySelector('.start-break');
    const cancelBBtn = document.querySelector('.cancel-break');
    const bTimer = document.querySelector('.break-timer');
    const sound = document.querySelector('#audio');
    let intervalId;
    let intervalId2;
    let bTime;
    let updatedTime2;

    //Custom timer lengths
    function getCustomTime2() {
        let val2 = document.querySelector('#length2').value;
        let bStartingMins = val2;
        bTime = bStartingMins * 60;
        console.log(val2, 'hi')
    }

    function startCountdown2() {
        intervalId2 = setInterval(timerFunc2, 1000);
    }

    function timerFunc2() {
        if (updatedTime2 === bTime) {
            getCustomTime2()
            let minutes = Math.floor(bTime / 60) //total seconds divided by 60
            let seconds = bTime % 60
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            bTimer.textContent = `${minutes}:${seconds}`;
            bTime--;
        } else {
            let minutes = Math.floor(bTime / 60) //total seconds divided by 60
            let seconds = bTime % 60 //total seconds mod 60 (remainder of minutes)
            if (minutes < 0 && seconds < 0) {
                playSound();
                return;
            } else {
                bTime--
            }
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            bTimer.textContent = `${minutes}:${seconds}`;
        }
    }

    function bStartOrPause() {
        if (!intervalId2) { //if not currently counting down
            intervalId2 = setInterval(timerFunc2, 1000);
            startBBtn.textContent = 'pausar'; //change btn to pause
        } else {
            clearInterval(intervalId2);
            intervalId2 = null;
            startBBtn.textContent = 'iniciar';
        }
    }

    function bCancelTimer() {
        let alert2 = confirm('Are you sure you want to stop this session?')
        if (alert2) {
            bTimer.textContent = '00:00'
            clearInterval(intervalId2); //cancels the timer
            intervalId2 = null; //this fixes the having to click on start twice
            startBBtn.textContent = 'iniciar';
            getCustomTime2();
        } else if (!alert && startBBtn.textContent === 'iniciar') {
            intervalId2 = setInterval(timerFunc2, 1000);
            startBBtn.textContent = 'pausar';
        } else {
            startBBtn.textContent = 'pausar';
        }
    }
</script>
-->

<!-- /.container-fluid -->
<!--fin de contenido principal-->
<?php
require_once "view_dash/inferior.php";
?>