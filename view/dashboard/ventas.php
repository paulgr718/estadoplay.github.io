<?php
require_once "../dashboard/view_dash/superior.php";
?>
<?php
include_once "../../conexion/cls_conexion.php";
/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
//include_once "../../controlador/ctl_lista_dispositivo.php";

?>
<?php
$consulta = "SELECT id, categoria FROM categoria";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- inicio de contenido principal -->
<div class="container">
    <h2 style="color:#848795">Ventas</h2>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">

                    <!-- Default box -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">

                                <div class="box-header with-border">
                                    <a class="nav-link" onclick="redireccion()"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>Nueva venta</button></a>
                                    <div class="box-tools pull-right"> <br>

                                    </div>
                                </div>
                                <script>
                                    function redireccion() {
                                        window.location.replace('../dashboard/ventasForm.php');
                                    }
                                </script>

                                <!--box-header-->
                                <!--centro-->
                                <?php
                                $consulta2 = "SELECT co.id_compra, cl.nombre,precio_total, co.fecha
from compra co
 inner join cliente cl on co.id_cliente = cl.id_cliente";
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


                                                            <th>Cliente</th>
                                                            <th>Pago total</th>
                                                            <th>Fecha emitida</th>
                                                            
                                                            <th>Acción</th>
                                                            <!--<th>Accion</th>-->

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $contador = 1;
                                                        foreach ($data10 as $dat) {
                                                        ?>
                                                            <tr>


                                                                <td>
                                                                    <center><?php echo $dat['nombre'] ?></center>
                                                                </td>
                                                                <td>
                                                                    <center>$ <?php echo $dat['precio_total'] ?></center>
                                                                </td>
                                                                <td>
                                                                    <center><?php echo $dat['fecha'] ?></center>
                                                                </td>
                                                                

                                                                <input type="hidden" id="id_<?php echo $contador; ?>" value="<?php echo $dat['id_compra']; ?>">
                                                                <input type="hidden" id="nombre_<?php echo $contador; ?>" value="<?php echo $dat['nombre']; ?>">

                                                                <td>
                                                                    <div class='text-center'>
                                                                        <div class='btn-group'><a class='btn btn-outline-danger btn_borrar' onclick="borrar(<?php echo $dat['id_compra']; ?>)" type='button'><i class='fas fa-fw fa-trash-alt'></i> </a><button type='button' class='btn btn-warning' onclick="agarrar(document.getElementById('id_<?php echo $contador; ?>').value,document.getElementById('nombre_<?php echo $contador; ?>').value)" class='btn btn-success' class="boton">Detalle</button></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            $contador = $contador + 1;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <script>
                                            var id_fila = "";

                                            function agarrar(id, nom) {

                                                $('#modalvent').modal('show');
                                                var Myelement = document.getElementById("idCom");
                                                Myelement.value = id;
                                                var Myelement = document.getElementById("nombre");
                                                Myelement.value = nom;
                                                id_fila = id;
                                                if (window.history.replaceState) {
                                                    window.history.replaceState("", "", "ventas.php" + "?detalle=" + id);
                                                }
                                                $("#tablaVent").load(" #tablaVent");
                                            }



                                            function borrar(id) {
                                                var respuesta = confirm("¿Está seguro de eliminar la compra seleccionada?");
                                                if (respuesta) {
                                                    $(document).on("click", ".btn_borrar", function() {
                                                        var dataTable = $('#tablaGH').DataTable();
                                                        dataTable
                                                            .row($(this).parents('tr'))
                                                            .remove()
                                                            .draw();
                                                    });
                                                    //
                                                    $.ajax({
                                                        url: "../../modelo/cls_ventas.php",
                                                        type: "POST",
                                                        dataType: "json",
                                                        data: {
                                                            tipo: 2,
                                                            id_compra: id
                                                        },
                                                        success: function(data) {
                                                            console.log(data);
                                                        }
                                                    });
                                                    swal({

                                                        title: "¡AVISO!",
                                                        text: "La compra fue borrada exitosamente",
                                                        type: "success",
                                                    });
                                                }
                                            }
                                        </script>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>


                </section>

            </div>


        </div>
    </div>
</div>

<div class="modal fade" id="modalvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="asdf" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle de ventas de <input style="border:0" type="text" id="nombre"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <input type="hidden" value="" id="idCom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive">
                                <table id="tablaVent" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                                    <?php
                                    if (isset($_GET["detalle"])) {
                                        $phpVar1 = $_GET["detalle"];
                                    } else {
                                        $phpVar1 = 0;
                                    }
                                    ?>
                                    <?php
                                    $consulta = "select CONCAT(pr.nombre, ' ', pr.descripcion) As producto, dt.cantidad, pr.precio_unitario, pr.precio_unitario*dt.cantidad as precio_total, co.fecha
                                    from detalle dt
                                    INNER join productos pr on dt.codigo_producto = pr.codigo
                                    inner join compra co on dt.id_compra = co.id_compra
                                    where co.id_compra=" . $phpVar1;
                                    $resultado = $conexion->prepare($consulta);
                                    $resultado->execute();
                                    $data2 = $resultado->fetchAll(PDO::FETCH_ASSOC);


                                    ?>
                                    <thead class="text-center" style="background-color:#007EFA; color:#ffffff">
                                        <tr>

                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>PVP</th>
                                            <th>Total</th>


                                            <!--<th>Accion</th>-->

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data2 as $dat) {
                                        ?>
                                            <tr>

                                                <td><?php echo $dat['producto'] ?></td>
                                                <td>
                                                    <center><?php echo $dat['cantidad'] ?></center>
                                                </td>
                                                <td>
                                                    <center>$ <?php echo $dat['precio_unitario'] ?></center>
                                                </td>
                                                <td>
                                                    <center>$ <?php echo $dat['precio_total'] ?></center>
                                                </td>



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
                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>

            </div>

        </div>
    </div>
</div>



<!--fin de contenido principal-->
<?php
require_once "../dashboard/view_dash/inferior.php";
?>