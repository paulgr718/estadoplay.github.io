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
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			
				
 			?>

<!-- inicio de contenido principal -->
    

<div class="container">
    <h2 style="color:#848795">Reporte de las ganancias del dia</h2>
</div><br>
<?php
                                                        $consulta2 = "select * from compra co inner join cliente cli on co.id_cliente = cli.id_cliente where co.fecha = CURDATE()";
                                                        $resultado2 = $conexion->prepare($consulta2);
                                                        $resultado2->execute();
                                                        $data10=$resultado2->fetchAll(PDO::FETCH_ASSOC);
                                                            
 					                                            ?>
                                              
                                              <div class="container">
                                            <div class="row">
                                                    <div class="col-lg-12">
                                                        
                                                        <div class="table-responsive">        
                                                            <table id="tablaGH" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                                                            <thead class="text-center" style="background-color:#007EFA; color:#ffffff" >
                                                                <tr>
                                                                  
                                                                    <th>Id</th>
                                                                    <th>Cliente</th>
                                                                    <th>Id cliente</th>
                                                                    <th>$ Total</th>
                                                                    <th>Fecha</th>
                                                                    <th>Accion</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php                            
                                                                foreach($data10 as $dat) {                                                        
                                                                ?>
                                                                <tr>
                                                                   
                                                                    <td><?php echo $dat['id_compra'] ?></td>
                                                                    <td><?php echo $dat['nombre'] ?></td>
                                                                    <td><?php echo $dat['id_cliente'] ?></td>
                                                                    <td><?php echo $dat['precio_total'] ?></td>
                                                                    <td><?php echo $dat['fecha'] ?></td>
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



<!--fin de contenido principal-->
<?php 
    require_once "../dashboard/view_dash/inferior.php";
?>