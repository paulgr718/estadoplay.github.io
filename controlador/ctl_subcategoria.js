$(document).ready(function(){
    tablaSub = $("#tablaSub").DataTable({
        "bDestroy":true,
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar4'>Editar</button><button class='btn btn-danger btnBorrar4'>Borrar</button></div></div>"  
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
    
$("#btnNuevoSub").click(function(){
    $("#formSub").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo dispositivo");            
    $("#modalCRUDSub").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar4", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    subcategoria = fila.find('td:eq(1)').text();
    id_categoria = parseInt(fila.find('td:eq(2)').text());
    
    
    $("#subcategoria").val(subcategoria);
    $("#id_categoria").val(id_categoria);
    
    
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar dispositivo");            
    $("#modalCRUDSub").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar4", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "../../modelo/cls_subcategoria.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaSub.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formSub").submit(function(e){
    e.preventDefault();    
    subcategoria = $.trim($("#subcategoria").val());  
    id_categoria = $.trim($("#id_categoria").val());

    
    
    $.ajax({
        url: "../../modelo/cls_subcategoria.php",
        type: "POST",
        dataType: "json",
        data: {subcategoria:subcategoria, id_categoria:id_categoria, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            subcategoria = data[0].subcategoria;
           id_categoria = data[0].id_categoria;
            categoria = data[0].categoria;
            
            if(opcion == 1){tablaSub.row.add([id,subcategoria,id_categoria,categoria]).draw();}
            else{tablaSub.row(fila).data([id,subcategoria,id_categoria,categoria]).draw();}            
        }        
    });
    $("#modalCRUDSub").modal("hide");    
    
});    
    
});