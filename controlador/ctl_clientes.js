$(document).ready(function(){
    tablaCli = $("#tablaCli").DataTable({
        "bDestroy":true,
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar6'>Editar</button><button class='btn btn-danger btnBorrar6'>Borrar</button></div></div>"  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": " _START_ al _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevoCli").click(function(){
    $("#formCat").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white"); 
    $(".modal-title").text("Nuevo Cliente");     
    $("#modalCRUDCli").modal("show");        
    id_cliente=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar6", function(){
    fila = $(this).closest("tr");
    id_cliente = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    
    
    $("#nombre").val(nombre);
   
    
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Cliente");            
    $("#modalCRUDCli").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar6", function(){    
    fila = $(this);
    id_cliente = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id_cliente+"?");
    if(respuesta){
        $.ajax({
            url: "../../modelo/cls_cliente.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id_cliente:id_cliente},
            success: function(){
                tablaCli.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formCli").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
   
    
    $.ajax({
        url: "../../modelo/cls_cliente.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre,  id_cliente:id_cliente, opcion:opcion},
        success: function(data){  
            console.log(data);
            id_cliente = data[0].id_cliente;            
            nombre = data[0].nombre;
            
           
            if(opcion == 1){tablaCli.row.add([id_cliente,nombre]).draw();}
            else{tablaCli.row(fila).data([id_cliente,nombre]).draw();}            
        }        
    });
    $("#modalCRUDCli").modal("hide");    
    
});    
    
});