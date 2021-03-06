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
 			$consulta = "select dp.id, dp.num_equipo, dp.equipo, dp.id_tipo, tp.serie, tp.marca, tp.nombre,dp.precio_uso
from dispositivos dp
inner join tipo tp on dp.id_tipo = tp.id";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC)
			
				
 			?>

<!-- inicio de contenido principal -->
    


<div class="container">
    <h2 style="color:#848795">Administrar Dispositivos</h2>
</div><br>

  <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevodp" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tabladp" class="table table-striped table-bordered table-condensed table-hover" style="width:99%">
                        <thead class="text-center" style="background-color:#007EFA; color:#ffffff" >
                             <tr>
                                <th>Id</th>
                                <th>N. equipo</th>
                                <th>equipo</th>              <th>Id tipo</th> 
                                <th>Serie</th> 
                                <th>Marca</th> 
                                <th>NOMBRE</th> 
                                <th>Precio fijado</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['num_equipo'] ?></td>
                                <td><?php echo $dat['equipo'] ?></td>
                                <td ><?php echo $dat['id_tipo'] ?></td>
                                <td><?php echo $dat['serie'] ?></td>
                                <td><?php echo $dat['marca'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['precio_uso'] ?></td>
                                    
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
<div class="modal fade" id="modalCRUDdp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formdp">    
            <div class="modal-body">
                <div class="form-group">
                        <label for="numero" class="col-form-label">N??mero equipo</label>
                        <input class="form-control" type="number" id="num_equipo">
                    </div>
                    <div class="form-group">
                        <label for="equipo" class="col-form-label">Equipo</label>
                        <!--<input class="form-control" type="text" id="equipo">-->
                        <select id="equipo" class="form-control" required>
				<option selected disabled value="">--Seleccione equipo--</option>
				<option>Computadora</option>
				<option>Realidad virual(vr)</option>
				<option>Consola</option>
				<option>Otra</option>
			</select>
                    </div>
                    <div class="form-group">
                        <label for="numero" class="col-form-label">Descripcion:</label>
                       <select class="form-control" id="id_tipo" required>
				<option selected disabled value="">--Seleccione la descripcion--</option>
				<?php 
					$query = $conexion->prepare("SELECT * FROM tipo");
					$query->execute();
					$dat = $query->fetchAll();	
					foreach ($dat as $valores):
					echo '<option value="'.$valores["id"].'">'.$valores["serie"]."--  (".$valores["nombre"].""."  (".$valores["marca"]."))".'</option>';
					endforeach;				
				?>
			</select>
                    </div>    
                    
                    
                    <div class="form-group">
                        <label for="precio" class="col-form-label">Precio fijado</label>
                        <input class="form-control" type="number" step="0.01" id="precio_uso">
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