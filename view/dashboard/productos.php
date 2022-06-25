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
 			$consulta = "SELECT pr.codigo, pr.nombre, pr.descripcion, cat.categoria, su.subcategoria,
 pr.precio_unitario, pr.stock, pr.id_subcategoria
 from productos pr
 inner join subcategoria su on pr.id_subcategoria = su.id
 inner join categoria cat on su.id_categoria = cat.id";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC)
			
				
 			?>

<!-- inicio de contenido principal -->
    


<div class="container">
    <h2 style="color:#848795">Administrar Productos</h2>
</div><br>

  <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoPro" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPro" class="table table-striped table-bordered table-condensed table-hover" style="width:99%">
                        <thead class="text-center" style="background-color:#007EFA; color:#ffffff" >
                             <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>         
                                <th>Categoria</th> 
                                <th>Subcategoria</th> 
                                <th>Precio</th> 
                                <th>Stock</th> 
                                 <th>Id subcategoria</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['codigo'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['descripcion'] ?></td>
                                <td ><?php echo $dat['categoria'] ?></td>
                                <td><?php echo $dat['subcategoria'] ?></td>
                                <td><?php echo $dat['precio_unitario'] ?></td>
                                <td><?php echo $dat['stock'] ?></td>
                                <td><?php echo $dat['id_subcategoria'] ?></td>
                                    
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
<div class="modal fade" id="modalCRUDPro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPro">    
            <div class="modal-body">

                <div class="form-group">
                        <label for="nombre" class="col-form-label">Nombre producto</label>
                        <input class="form-control" type="text" id="nombre">
                    </div>
                
                <div class="form-group">
                        <label for="nombre" class="col-form-label">Descripcion</label>
                        <input class="form-control" type="text" id="descripcion">
                    </div>
                <div class="form-group">
                        <label for="categoria" class="col-form-label">Subcategoria</label>
                        <!--<input c lass="form-control" type="text" id="equipo">-->
                        <select class="form-control" id="id_subcategoria" required>
				<option selected disabled value="">--Seleccione la subcategoria--</option>
				<?php 
					$query = $conexion->prepare("SELECT * FROM subcategoria");
					$query->execute();
					$dat = $query->fetchAll();	
					foreach ($dat as $valores):
					echo '<option value="'.$valores["id"].'">'.$valores["subcategoria"].'</option>';
					endforeach;				
				?>
			</select>
                    </div>
                <div class="form-group">
                        <label for="codigo" class="col-form-label">Precio unitario</label>
                        <input class="form-control" type="number" id="precio_unitario" step="0.01">
                    </div> 
                    
                    
                    <div class="form-group">
                        <label for="precio" class="col-form-label">Stock</label>
                        <input class="form-control" type="number" id="stock">
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