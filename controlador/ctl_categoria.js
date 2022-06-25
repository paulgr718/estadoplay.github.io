$(document).ready(function(){
    tablaCat = $("#tablaCat").DataTable({
        "bDestroy":true,
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar3'>Editar</button><button class='btn btn-danger btnBorrar3'>Borrar</button></div></div>"  
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
    
$("#btnNuevoCat").click(function(){
    $("#formCat").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva categoria");            
    $("#modalCRUDCat").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar3", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    categoria = fila.find('td:eq(1)').text();
    
    
    $("#categoria").val(categoria);
   
    
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Categoria");            
    $("#modalCRUDCat").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar3", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "../../modelo/cls_categoria.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaCat.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formCat").submit(function(e){
    e.preventDefault();    
    categoria = $.trim($("#categoria").val());
   
    
    $.ajax({
        url: "../../modelo/cls_categoria.php",
        type: "POST",
        dataType: "json",
        data: {categoria:categoria,  id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            categoria = data[0].categoria;
            
           
            if(opcion == 1){tablaCat.row.add([id,categoria]).draw();}
            else{tablaCat.row(fila).data([id,categoria]).draw();}            
        }        
    });
    $("#modalCRUDCat").modal("hide");    
    
});    
    
});