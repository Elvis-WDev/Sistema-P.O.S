

/*=============================================
=                   SIDEBAR MENÚ                   =
=============================================*/

$('.sidebar-menu').tree();

/*============  End of SIDEBAR MENÚ  =============*/


/*=============================================
=                   DATABLE                   =
=============================================*/

$(".tablas").DataTable({

    // Cambio de idioma pra DataTable

    language: {

        "decimal": "",
        "emptyTable": "No hay datos disponibles en la tabla.",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ entradas.",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 entradas.",
        "infoFiltered": "(Filtrando desde _MAX_ entradas totales.)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ entradas.",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron registros coincidentes.",
        "paginate": {

            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"

        },
        "aria": {

            "sortAscending": ": Activar para ordenar columna ascendente",
            "sortDescending": ": Activar para ordenar columna descendente"

        }

    },

    responsive: true

});

/*=============================================
=                   ICKECK                   =
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({

    checkboxClass: "icheckbox_minimal-blue",
    radioClass: "iradio_minimal-blue"

});

/*=============================================
=                   InputMask                   =
=============================================*/

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask();
