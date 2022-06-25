$(document).ready(function(){
    tablaPro = $("#tablaPro").DataTable({
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
    
$("#btnNuevoPro").click(function(){
    $("#formPro").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo producto");            
    $("#modalCRUDPro").modal("show");        
    codigo=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar4", function(){
    fila = $(this).closest("tr");
    codigo = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    descripcion = fila.find('td:eq(2)').text();
    id_subcategoria = parseInt(fila.find('td:eq(7)').text());
    precio_unitario = fila.find('td:eq(5)').text();
    stock = fila.find('td:eq(6)').text();
    
    
    $("#nombre").val(nombre);
    $("#descripcion").val(descripcion);
    $("#id_subcategoria").val(id_subcategoria);
    $("#precio_unitario").val(precio_unitario);
    $("#stock").val(stock);
    
    
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar productos");            
    $("#modalCRUDPro").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar4", function(){    
    fila = $(this);
    codigo = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+codigo+"?");
    if(respuesta){
        $.ajax({
            url: "../../modelo/cls_producto.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, codigo:codigo},
            success: function(){
                tablaPro.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formPro").submit(function(e){
    e.preventDefault();    
    

    nombre = $.trim($("#nombre").val());
    descripcion = $.trim($("#descripcion").val());
    id_subcategoria = $.trim($("#id_subcategoria").val());
    precio_unitario = $.trim($("#precio_unitario").val());
    stock = $.trim($("#stock").val());
    
    
    
    $.ajax({
        url: "../../modelo/cls_producto.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, descripcion:descripcion, precio_unitario:precio_unitario, stock:stock, id_subcategoria:id_subcategoria, codigo:codigo, opcion:opcion},
        success: function(data){  
            console.log(data);
            codigo = data[0].codigo;            
            descripcion = data[0].descripcion;
            nombre = data[0].nombre;
            categoria = data[0].nombre;
            subcategoria = data[0].subcategoria;
            precio_unitario = data[0].precio_unitario;
            stock = data[0].stock;
           id_subcategoria = data[0].id_subcategoria;
            
            
            if(opcion == 1){tablaPro.row.add([codigo,descripcion,nombre,categoria,subcategoria,precio_unitario,stock,id_subcategoria]).draw();}
            else{tablaPro.row(fila).data([codigo,descripcion,nombre,categoria,subcategoria,precio_unitario,stock,id_subcategoria]).draw();}            
        }        
    });
    $("#modalCRUDPro").modal("hide");    
    
});    
    
});