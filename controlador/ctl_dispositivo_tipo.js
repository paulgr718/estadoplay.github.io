$(document).ready(function(){
    tablaTip = $("#tablaTip").DataTable({
        "bDestroy":true,
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
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
    
$("#btnNuevoTip").click(function(){
    $("#formTip").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Tipo de dispositivo");            
    $("#modalCRUDTip").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    serie = fila.find('td:eq(1)').text();
    marca = fila.find('td:eq(2)').text();
    nombre = fila.find('td:eq(3)').text();
    
    
    $("#serie").val(serie);
    $("#marca").val(marca);
    $("#nombre").val(nombre);
    
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Tipo de dispositivo");            
    $("#modalCRUDTip").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "../../modelo/cls_dispositivo_tipo.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaTip.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formTip").submit(function(e){
    e.preventDefault();    
    serie = $.trim($("#serie").val());
    marca = $.trim($("#marca").val());
    nombre = $.trim($("#nombre").val());
    
    $.ajax({
        url: "../../modelo/cls_dispositivo_tipo.php",
        type: "POST",
        dataType: "json",
        data: {serie:serie, marca:marca, nombre:nombre,  id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            serie = data[0].serie;
            marca = data[0].marca;
            nombre = data[0].nombre;
           
            if(opcion == 1){tablaTip.row.add([id,serie,marca,nombre]).draw();}
            else{tablaTip.row(fila).data([id,serie,marca,nombre]).draw();}            
        }        
    });
    $("#modalCRUDTip").modal("hide");    
    
});    
    
});