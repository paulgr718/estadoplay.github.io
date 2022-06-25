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
$consulta = "select * from cliente where estado='a'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<!-- inicio de contenido principal -->


<div class="container">
    <h2 style="color:#848795">Generar venta</h2>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="panel-body" id="formularioregistros">
                <form action="" name="formulario" id="formulario" method="POST">
                    <div class="form-group col-lg-8 col-md-8 col-xs-12">
                        <div class="form-group col-lg-4 col-md-4 col-xs-12">
                            <label for="">Fecha de emision: </label>
                            <?php $fcha = date("Y-m-d"); ?>
                            <input class="form-control bg-light border-3 small" type="date" name="fecha_hora" id="fecha_hora" readonly>
                            <script>
                                var now = new Date();
                                var day = ("0" + now.getDate()).slice(-2);
                                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                                var today = now.getFullYear() + "-" + (month) + "-" + (day);
                                $("#fecha_hora").val(today);
                            </script>
                        </div>
                        <div class="form-group col-lg-9 col-md-9 col-xs-12">
                            <label for="">Cliente(*):</label>
                            <input class="form-control" type="hidden" name="idventa" id="idventa">

                            <div class="input-group">
                                <input type="hidden" id="idClie">
                                <input type="text" name="clientes" class="form-control bg-light border-3 small" aria-label="Search" aria-describedby="basic-addon2" readonly required placeholder="clic en la lupa para añadir cliente" id="cliente">

                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="btnAgregarClie" data-toggle="modal">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>



                        </div>
                    </div>

                    <!-- Modal para añadir clientes -->
                    <div class="modal fade" id="modalClie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <?php
                                    $consulta = "select * from cliente where estado='a'";
                                    $resultado = $conexion->prepare($consulta);
                                    $resultado->execute();
                                    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);


                                    ?>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table id="tablaClie" class="table table-striped table-bordered table-condensed table-hover" style="width:99%">
                                                        <thead class="text-center" style="background-color:#007EFA; color:#ffffff">
                                                            <tr>

                                                                <th>Id</th>
                                                                <th>Cliente</th>
                                                                <th>Opcion</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $contador = 1;
                                                            foreach ($data as $dat) {
                                                            ?>
                                                                <tr>



                                                                    <td><?php echo $dat['id_cliente'] ?></td>
                                                                    <td><?php echo $dat['nombre'] ?></td>
                                                                    <input type="hidden" id="id_<?php echo $contador; ?>" value="<?php echo $dat['id_cliente']; ?>">

                                                                    <input type="hidden" id="nombre_<?php echo $contador; ?>" value="<?php echo $dat['nombre']; ?>">

                                                                    <td>
                                                                        <div class='text-center'>


                                                                            <div class='btn-group'><a class='btn btn-outline-primary' style='border-radius: 10px 100px / 120px;' type='button' onclick="agarrar(document.getElementById('id_<?php echo $contador; ?>').value,document.getElementById('nombre_<?php echo $contador; ?>').value)"><span class='fa fa-plus'></span> </a> </div>
                                                                        </div>
                                                                    </td>

                                                                    <script>
                                                                        var id_cliente = 0;

                                                                        function agarrar(id, nom) {
                                                                            id_cliente = id;
                                                                            $('#modalClie').modal('hide');
                                                                            var Myelement = document.getElementById("idClie");
                                                                            Myelement.value = id;
                                                                            var Myelement = document.getElementById("cliente");
                                                                            Myelement.value = nom;


                                                                        }
                                                                    </script>

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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- fin de modal para añadir clientes -->

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a data-toggle="modal" id="btnAgregarProd">
                            <button type="button" class="btn btn-primary"><span class="fa fa-plus" data-toggle="modal"></span>Agregar producto</button>
                        </a>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive" id="tttt">
                                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                            <thead class="text-center" style="background-color:#A9D0F5">
                                                <th>Opciones</th>
                                                <th>Cod. producto</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio Venta</th>
                                                <th>Subtotal</th>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <th>TOTAL</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <h4 id="total">$ 0.00</h4><input type="hidden" name="total_venta" id="total_venta">
                                                </th>
                                            </tfoot>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="button" id="btnGudardar" onclick="btnGuardar()"><i class="fa fa-save"></i> Guardar</button>
                        <button class="btn btn-danger" type="button" id="btnCancelar" onclick="btnCancel()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    </div>

                    <script>
                        function btnCancel() {

                            swal({
                                    title: "¿Aviso!",
                                    text: "¿Desea cancelar la venta?",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonText: "Aceptar",
                                    cancelButtonText: "Cancelar",
                                })
                                .then(resultado => {
                                    if (resultado.value) {


                                    } else {
                                        // Dijeron que no
                                        window.location.replace('../dashboard/ventas.php');
                                    }
                                });

                        }
                    </script>
                    <script>
                        function btnGuardar() {
                            var pp = document.getElementById("total").innerText;
                            pp = pp.split("$");
                            pp = pp[1].trim();
                            $.ajax({
                                url: "../../modelo/cls_ventas.php",
                                type: "POST",
                                dataType: "json",
                                data: {
                                    tipo: 0,
                                    id_cliente: id_cliente,
                                    precio: pp
                                },
                                success: function() {
                                    console.log("insercion de compra correcta");
                                }
                            });
                            var dt = document.getElementById("detalles");
                            for (var i = 0; i < dt.rows.length - 2; i++) {
                                var canti = dt.childNodes[3].children[i].children[3].childNodes[0].childNodes[0].value;
                                var prod = dt.childNodes[3].children[i].children[1].innerText;
                                $.ajax({
                                    url: "../../modelo/cls_ventas.php",
                                    type: "POST",
                                    dataType: "json",
                                    data: {
                                        tipo: 1,
                                        cod: prod,
                                        canti: canti
                                    },
                                    success: function(sucess) {
                                       
                                        console.log(sucess);
                                    }
                                });
                            }
                            swal({

                                title: "¡AVISO!",
                                text: "Su venta se generó exitosamente",
                                type: "success",
                            });
                            window.location = "ventas.php";
                        }
                    </script>
                </form>
            </div>
            <div class="modal fade" id="modalProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formPro">
                            <div class="modal-body">

                                <?php
                                $consulta = "SELECT pr.codigo, pr.nombre, pr.descripcion,
                 pr.precio_unitario, pr.stock
                 from productos pr
                 inner join subcategoria su on pr.id_subcategoria = su.id
                 inner join categoria cat on su.id_categoria = cat.id";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $data = $resultado->fetchAll(PDO::FETCH_ASSOC)


                                ?>


                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table id="tablaProd" class="table table-striped table-bordered table-condensed table-hover" style="width:99%">
                                                    <thead class="text-center" style="background-color:#007EFA; color:#ffffff">
                                                        <tr>

                                                            <th>Codigo</th>
                                                            <th>Producto</th>
                                                            <th>Descripcion</th>
                                                            <th>PVP</th>
                                                            <th>Stock</th>
                                                            <th>Opcion</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $cont = 1;
                                                        foreach ($data as $dat2) {
                                                        ?>
                                                            <tr>



                                                                <td>
                                                                    <center><?php echo $dat2['codigo'] ?></center>
                                                                </td>
                                                                <td><?php echo $dat2['nombre'] ?></td>
                                                                <td><?php echo $dat2['descripcion'] ?></td>
                                                                <td>$ <?php echo $dat2['precio_unitario'] ?></td>
                                                                <td><?php echo $dat2['stock'] ?></td>

                                                                <input type="hidden" id="cod_<?php echo $cont; ?>" value="<?php echo $dat2['codigo']; ?>">

                                                                <input type="hidden" id="nombrep_<?php echo $cont; ?>" value="<?php echo $dat2['nombre'] ?>">
                                                                <input type="hidden" id="descripcion_<?php echo $cont; ?>" value="<?php echo $dat2['descripcion'] ?>">
                                                                <input type="hidden" id="nomDesc_<?php echo $cont; ?>" value="<?php echo $dat2['nombre'] . ' ' . $dat2['descripcion'] ?>">
                                                                <input type="hidden" id="pvp_<?php echo $cont; ?>" value="<?php echo $dat2['precio_unitario']; ?>">


                                                                <td>
                                                                    <div class='text-center'>

                                                                        <div class='btn-group'><a class='btn btn-outline-primary' style='border-radius: 10px 100px / 120px;' type='button' onclick="agregar(document.getElementById('cod_<?php echo $cont; ?>').value,document.getElementById('nombrep_<?php echo $cont; ?>').value,document.getElementById('descripcion_<?php echo $cont; ?>').value,document.getElementById('nomDesc_<?php echo $cont; ?>').value,document.getElementById('pvp_<?php echo $cont; ?>').value)" class="boton"><span class='fa fa-plus'></span> </a></div>
                                                                    </div>
                                                                </td>
                                                                <script>
                                                                    var cod_row = "";

                                                                    function agregar(cod, nom, des, nd, pvp) {
                                                                        $('#modalProd').modal('hide');
                                                                        var dataTable = $('#detalles').DataTable();

                                                                        var row = dataTable.row.add([
                                                                            "<center><a class='btn btn-outline-danger btn_borrar' style='border-radius: 10px 100px / 120px;' type='button'><i class='fas fa-fw fa-trash-alt'></i> </a> </center>",
                                                                            cod,
                                                                            nom,
                                                                            "<center><input type='number' value='1' class='form-control bg-light border-3 small cantidad_input' style='width : 60px; heigth : 1px; border-radius: 10px 100px / 120px'></center>",
                                                                            pvp,
                                                                            (1 * pvp)
                                                                        ]).draw(false);
                                                                        id_row = cod;
                                                                        var dt = document.getElementById("detalles");
                                                                        var total = 0;
                                                                        for (var i = 0; i < dt.rows.length - 2; i++) {
                                                                            var canti = dt.childNodes[3].children[i].children[3].childNodes[0].childNodes[0].value;
                                                                            var precio = dt.childNodes[3].children[i].children[4].innerText;
                                                                            dt.childNodes[3].children[i].children[5].innerText = parseFloat(canti * precio);
                                                                            var Myelement = document.getElementById("total");
                                                                            var subt = parseFloat(dt.childNodes[3].children[i].children[5].innerText);
                                                                            total += subt;
                                                                            Myelement.innerText = "$ " + parseFloat(total);
                                                                        }
                                                                    }
                                                                    $(document).on("click", ".btn_borrar", function() {
                                                                        var dataTable = $('#detalles').DataTable();
                                                                        var total = 0;
                                                                        var dt = document.getElementById("detalles");
                                                                        dataTable
                                                                            .row($(this).parents('tr'))
                                                                            .remove()
                                                                            .draw();
                                                                        for (var i = 0; i < dt.rows.length - 2; i++) {
                                                                            var canti = dt.childNodes[3].children[i].children[3].childNodes[0].childNodes[0].value;
                                                                            var precio = dt.childNodes[3].children[i].children[4].innerText;
                                                                            dt.childNodes[3].children[i].children[5].innerText = parseFloat(canti * precio);
                                                                            var Myelement = document.getElementById("total");
                                                                            var subt = parseFloat(dt.childNodes[3].children[i].children[5].innerText);
                                                                            total += subt;
                                                                            Myelement.innerText = "$ " + parseFloat(total);
                                                                        }
                                                                    });

                                                                    $(document).on("input", ".cantidad_input", function() {
                                                                        var total = 0;
                                                                        var dataTable = document.getElementById("detalles");
                                                                        for (var i = 0; i < dataTable.rows.length - 2; i++) {
                                                                            var canti = dataTable.childNodes[3].children[i].children[3].childNodes[0].childNodes[0].value;
                                                                            var precio = dataTable.childNodes[3].children[i].children[4].innerText;
                                                                            dataTable.childNodes[3].children[i].children[5].innerText = parseFloat(canti * precio);
                                                                            var Myelement = document.getElementById("total");
                                                                            var subt = parseFloat(dataTable.childNodes[3].children[i].children[5].innerText);
                                                                            total += subt;
                                                                            Myelement.innerText = "$ " + parseFloat(total);
                                                                        }
                                                                    });
                                                                </script>

                                                            </tr>
                                                        <?php
                                                            $cont = $cont + 1;
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
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!--Modal para v CRUD-->



<!--fin de contenido principal-->
<?php
require_once "../dashboard/view_dash/inferior.php";
?>