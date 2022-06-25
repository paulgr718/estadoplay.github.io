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
 			$consulta = "SELECT id, serie, marca, nombre FROM tipo";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			
				
 			?>

<!-- inicio de contenido principal -->
    

<div class="container">
    <h2 style="color:#848795">Gestion tipo de dispositivos</h2>
</div><br>

  <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoTip" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaTip" class="table table-striped table-bordered table-condensed table-hover" style="width:99%">
                        <thead class="text-center" style="background-color:#007EFA; color:#ffffff" >
                            <tr>
                                <th>Id</th>
                                <th>Serie</th>
                                <th>MARCA</th>              <th>NOMBRE</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['serie'] ?></td>
                                <td><?php echo $dat['marca'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                    
                                <td></td>
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
      
<!--Modal para v CRUD-->
<div class="modal fade" id="modalCRUDTip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formTip">    
            <div class="modal-body">
                <div class="form-group">
                <label for="serie" class="col-form-label">Número de serie:</label>
                <input type="number" class="form-control" id="serie">
                </div>
                <div class="form-group">
                <label for="detalle" class="col-form-label">Marca:</label>
                <input type="text" class="form-control" id="marca">
                </div>
                <div class="form-group">
                <label for="serie" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                
                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Aceptar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  



<!--fin de contenido principal-->
<?php 
    require_once "../dashboard/view_dash/inferior.php";
?>