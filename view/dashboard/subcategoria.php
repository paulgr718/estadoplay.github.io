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
 			$consulta = "select su.id, su.subcategoria, su.id_categoria, cat.categoria
from subcategoria su
inner join categoria cat on su.id_categoria = cat.id;";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC)
			
				
 			?>

<!-- inicio de contenido principal -->
    


<div class="container">
    <h2 style="color:#848795">Administrar subcategoria</h2>
</div><br>

  <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoSub" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaSub" class="table table-striped table-bordered table-condensed table-hover" style="width:99%">
                        <thead class="text-center" style="background-color:#007EFA; color:#ffffff" >
                             <tr>
                                <th>Id</th>
                                <th>Subcategoria</th>
                                <th>Id categoria</th>              
                                 <th>Categoria</th> 
                                
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['subcategoria'] ?></td>
                                <td><?php echo $dat['id_categoria'] ?></td>
                                <td ><?php echo $dat['categoria'] ?></td>
                               
                                    
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
<div class="modal fade" id="modalCRUDSub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formSub">    
            <div class="modal-body">
                <div class="form-group">
                        <label for="subcategoria" class="col-form-label">Subcategoria</label>
                        <input class="form-control" type="text" id="subcategoria">
                    </div>
                    <div class="form-group">
                        <label for="categoria" class="col-form-label">Categoria:</label>
                       <select class="form-control" id="id_categoria" required>
				<option selected disabled value="">--Seleccione la categoria--</option>
				<?php 
					$query = $conexion->prepare("SELECT * FROM categoria");
					$query->execute();
					$dat = $query->fetchAll();	
					foreach ($dat as $valores):
					echo '<option value="'.$valores["id"].'">'.$valores["categoria"].'</option>';
					endforeach;				
				?>
			</select>
                    </div>    
                    
                
                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar2" class="btn btn-dark">Aceptar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  


<!--fin de contenido principal-->
<?php 
    require_once "../dashboard/view_dash/inferior.php";
?>