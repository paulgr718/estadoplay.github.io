$(document).ready(function(){
    $("#tablaDas").DataTable({
        "bDestroy":true,
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": " _START_ al _END_ de _TOTAL_ registros",
            "infoEmpty": "0 al 0 de 0 registros",
            "infoFiltered": "(filtrado de _MAX_ registros)",
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
    
});