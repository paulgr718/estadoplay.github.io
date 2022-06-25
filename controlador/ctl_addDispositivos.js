$(document).ready(function(){
    tabladp = $("#tabladp").DataTable({
        "bDestroy":true,
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar2'>Editar</button><button class='btn btn-danger btnBorrar2'>Borrar</button></div></div>"  
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
    
$("#btnNuevodp").click(function(){
    $("#formdp").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo dispositivo");            
    $("#modalCRUDdp").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar2", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    num_equipo = parseInt(fila.find('td:eq(1)').text());
    equipo = fila.find('td:eq(2)').text();
    id_tipo = parseInt(fila.find('td:eq(3)').text());
    precio_uso = fila.find('td:eq(7)').text();
    
    
    $("#num_equipo").val(num_equipo);
    $("#equipo").val(equipo);
    $("#id_tipo").val(id_tipo);
     $("#precio_uso").val(precio_uso);
    
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar dispositivo");            
    $("#modalCRUDdp").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar2", function(){    
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
                tabladp.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formdp").submit(function(e){
    e.preventDefault();    
    num_equipo = $.trim($("#num_equipo").val());
    equipo = $.trim($("#equipo").val());
    id_tipo = $.trim($("#id_tipo").val());
    precio_uso = $.trim($("#precio_uso").val());
    
    
    $.ajax({
        url: "../../modelo/cls_dispositivo.php",
        type: "POST",
        dataType: "json",
        data: {num_equipo:num_equipo, equipo:equipo,  precio_uso:precio_uso, id_tipo:id_tipo, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            num_equipo = data[0].num_equipo;
            equipo = data[0].equipo;
            
           id_tipo = data[0].id_tipo;
            serie = data[0].serie;
            marca = data[0].marca;
            nombre = data[0].nombre;
            precio_uso = data[0].precio_uso;
            
            if(opcion == 1){tabladp.row.add([id,num_equipo,equipo, id_tipo,serie, marca, nombre, precio_uso]).draw();}
            else{tabladp.row(fila).data([id,num_equipo,equipo, id_tipo,serie, marca, nombre, precio_uso]).draw();}            
        }        
    });
    $("#modalCRUDdp").modal("hide");    
    
});    
    
});