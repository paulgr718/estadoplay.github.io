$(document).ready(function(){
    $("#tablaClie").DataTable({    
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
    
$("#btnAgregarClie").click(function(){
    $(".modal-header").css("background-color", "white");
    $(".modal-header").css("color", "dark"); 
    $(".modal-title").text("Seleccione el cliente");     
    $("#modalClie").modal("show");        

});    

        $("#tablaProd").DataTable({
             
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

    $("#btnAgregarProd").click(function(){
    $(".modal-header").css("background-color", "white");
    $(".modal-header").css("color", "dark"); 
    $(".modal-title").text("Seleccione el producto");     
    $("#modalProd").modal("show");        

});
});
