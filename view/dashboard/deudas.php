<?php 
    require_once "../dashboard/view_dash/superior.php";
?>
<?php 
include_once "../../conexion/cls_conexion.php";
/*$objeto = new Conexion();
$conexion = $objeto->Conectar();*/
//include_once "../../controlador/ctl_lista_dispositivo.php";

?>


<!-- inicio de contenido principal -->
    

<div class="container">
    <h2 style="color:#848795">Administrar deudas de clientes</h2>
</div><br>

  <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevodeu" type="button" class="btn btn-success" data-toggle="modal" onclick="abrir()">Añadir deuda</button>  
                <script>
                    function abrir() {

                                                $('#modalCRUDdeu').modal('show');
                                                
                                            }
                </script>
            </div>    
        </div>    
    </div>    
    <br>  
    <?php 
                                                $consulta = "select *
                                                    from cliente cli
                                                    inner join deuda de on de.id_cliente = cli.id_cliente";
                                                $resultado = $conexion->prepare($consulta);
                                                $resultado->execute();
                                                $data5=$resultado->fetchAll(PDO::FETCH_ASSOC);


                                                            ?>
                                              
                                            <div class="container">
                                            <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive">        
                                                            <table id="tabladt" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                                                            <thead class="text-center" style="background-color:#007EFA; color:#ffffff" >
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Cliente</th>
                                                                    <th>Fecha de emision</th>
                                                                    <th>Total deuda</th>
                                                                    <th>Estado</th>
                                                                    <th>Accion</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php   
                                                                $contador = 1;
                                                                foreach($data5 as $dat) {                                                        
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $dat['id'] ?></td>
                                                                    <td><?php echo $dat['nombre'] ?></td>
                                                                    <td><?php echo $dat['fecha'] ?></td>
                                                                    <td><?php echo $dat['valor_deuda'] ?></td>
                                                                    <input type="hidden" id="id_<?php echo $contador; ?>" value="<?php echo $dat['id'] ?>; ?>">
                                                            <?php
                                                            if ($dat['estado'] == "pendiente") { ?>
                                                                    <td><span class="badge bg-warning"><?php echo $dat['estado'] ?></span></td>
                                                                    
                                                                    <td><div class='text-center'><div class='btn-group'><button class='btn btn-primary' href="#btnEditar" data-toggle="modal">Editar</button><button class='btn btn-danger ' href="#btnBorrar" data-toggle="modal" id="btnedit">Borrar</button></div>⠀⠀⠀<div class='btn-group'><button class='btn btn-success' href="#btnPagar" data-toggle="modal">Pagar</button><button class='btn btn-warning '  data-toggle="modal" id="btnDet" onclick="detalle(document.getElementById('id_<?php echo $contador; ?>').value)">Detalle</button></div></div></td>
                                                                    
                                                                    <?php } else { ?>
                                                                    
                                                                    <td><span class="badge bg-success text-white"><?php echo $dat['estado'] ?></span></td>
                                                                    
                                                                    <td><div class='text-center'><div class='btn-group'><button class='btn btn-danger' href="#btnBorrar" data-toggle="modal">Borrar</button><button class='btn btn-warning '  data-toggle="modal" id="btnedet" onclick="detalle(document.getElementById('id_<?php echo $contador; ?>').value)">Detalle</button></div></div></td>
                                                                    
                                                                    <?php } ?>
                                                                </tr>
                                                                <?php
                                                                    $contador = $contador + 1;
                                                                    }
                                                                ?> 
                                                                
                                                               
                                                            </tbody>        
                                                           </table> 
                                                            <script>
                                                            
                                                            function detalle(id) {

                                                $('#modalDeu').modal('show');
                                                var Myelement = document.getElementById("idDeu");
                                                Myelement.value = id;
                                                
                                                id_fila = id;
                                                if (window.history.replaceState) {
                                                    window.history.replaceState("", "", "deudas.php" + "?detalle=" + id);
                                                }
                                                $("#tabladt").load(" #tabladt");
                                            }
                                                            </script>
                                                            
                                                            <script>
                                                                
                                                                var Var_JavaScript = 5;  
                                                                var id = 0;
                                                     var fila; //capturar la fila para editar o borrar el registro
    
    
                                                             $(document).on("click", "#btnDet", function(){
                                                                    fila = $(this).closest("tr");
                                                                    id = parseInt(fila.find('td:eq(0)').text());
                                                                    console.log(id);
                                                                 sessionStorage.setItem('id',id);
                                                                            }
                                                                    
                                                                );
                                                             // declaración de la variable </script>  
                                                            <?php
                                                                            $var_PHP = "<script> document.writeln(id); </script>"; // igualar el valor de la variable JavaScript a PHP 

                                                                        echo $var_PHP   // muestra el resultado 

                                                                        ?>
                                                        </div>
                                                    </div>
                                            </div>  
                                        </div>  
<div class="modal fade" id="modalCRUDdeu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Abrir nueva deuda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formdeu" action="deudas.php" method="post">    
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="numero" class="col-form-label">Cliente:</label>
                       <select class="form-control" id="id_tipo" required name="id_cliente">
				<option selected disabled value="">--cliente--</option>
				<?php 
					$query = $conexion->prepare("SELECT * FROM cliente");
					$query->execute();
					$dat = $query->fetchAll();	
					foreach ($dat as $valores):
					echo '<option value="'.$valores["id_cliente"].'">'.$valores["nombre"].'</option>';
					endforeach;				
				?>
			</select> 
                    </div>    
                    
                    <input type="hidden" name="estado_de" value="pendiente">
                    <input type="hidden" name="fecha" value="2022-05-03">
                    <div class="form-group">
                        <label for="precio" class="col-form-label">Total de deuda</label>
                        <input class="form-control" type="number" step="0.01" id="precio_uso" name="valor_deuda">
                    </div>
                
                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark" name="guardar">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

<?php 
if (isset($_POST['guardar'])) {
	
 $a = $_POST['id_cliente'];
 $b = $_POST['valor_deuda'];
 $e = $_POST['estado_de'];
    

$sql = "insert into deuda (valor_deuda,fecha,id_cliente,estado) values (:valor_deuda, curdate() , :id_cliente, :estado_de)";
 $sentencia =$conexion->prepare($sql);
 $sentencia->bindParam(':valor_deuda', $b);
 
 $sentencia->bindParam(':id_cliente', $a);
 $sentencia->bindParam(':estado_de', $e);
  $sentencia->execute();

}
?>


<!--Modal para v CRUD-->
<div class="modal fade" id="modalDeu" tabindex="-1" role="dialog" aria-labelledby="deudas" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="deudas">Detalle de la deuda</h5>
                                                <?php
                                    if (isset($_GET["detalle"])) {
                                        $phpVar2 = $_GET["detalle"];
                                    } else {
                                        $phpVar2 = 0;
                                    }
                                    ?>
                                           <?php 
                                                $consulta = "select *
                                                        from  deuda de
                                                        inner join detalle_deuda dt on de.id= dt.id_deuda WHERE dt.id_deuda= .$phpVar2";
                                                $resultado = $conexion->prepare($consulta);
                                                $resultado->execute();
                                                $data6=$resultado->fetchAll(PDO::FETCH_ASSOC);


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
                                                                            $var_PHP = "<script> sessionStorage.setItem(id); </script>"; // igualar el valor de la variable JavaScript a PHP 

                                                                        echo $var_PHP   // muestra el resultado 

                                                                        ?>
                                                        <div class="table-responsive">        
                                                            <table id="tabladtde" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                                                            <thead class="text-center" style="background-color:#007EFA; color:#ffffff" >
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Detalle</th>
                                                                    <th>valor Unitario</th>
                                                                    <th>Id deuda</th>
                                                                    
                                                                    
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php                            
                                                                foreach($data6 as $dat) {                                                        
                                                                ?>
                                                                <tr>
                                                                   <td><?php echo $dat['id'] ?></td>
                                                                    <td><?php echo $dat['detalle'] ?></td>
                                                                    <td><?php echo $dat['valor_unitario'] ?></td>
                                                                    <td><?php echo $dat['id_deuda'] ?></td>
                                                                    
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