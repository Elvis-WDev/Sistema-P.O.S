
/*=============================================
=  CARGAR LA TABLA DINAMICA DE PRODUCTOS                   =
=============================================*/

// $.ajax({

//     url: "ajax/datatable-clientes_ajax.php",
//     success: function (respuesta) {

//         console.log('Repspuiesta: ', respuesta);

//     }

// })

$('.tableClientes').DataTable({
    "ajax": "ajax/datatable-clientes_ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});


/*=============================================
=                   EDITAR CLIENTES                   =
=============================================*/

$('.tableClientes tbody').on('click', 'button.btn_EditarCliente', function () {

    var id_cliente = $(this).attr('id-cliente');

    var data = new FormData();
    data.append('id-cliente', id_cliente);

    $.ajax({

        url: 'ajax/clientes-ajax.php',
        method: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (respuesta) {

            $('#txt_edit_cliente_id').val(respuesta['id_cliente']);
            $('#txt_edit_cliente_nombre').val(respuesta['nombre_cliente']);
            $('#txt_edit_cliente_document').val(respuesta['documento_cliente']);
            $('#txt_edit_cliente_mail').val(respuesta['email_cliente']);
            $('#txt_edit_cliente_telefono').val(respuesta['telefono_cliente']);
            $('#txt_edit_cliente_direccion').val(respuesta['direccion_cliente']);
            $('#txt_edit_cliente_fechaNacimiento').val(respuesta['fecha_nacimiento_cliente']);
            $('#txt_fecha_registro').val(respuesta['fecha_cliente']);

        }

    })

})

/*=============================================
=                   DELETE CLIENTES           =
=============================================*/

$('.tableClientes tbody').on('click', 'button.btn_DeleteCliente', function () {

    var id_client = $(this).attr('id-cliente');

    Swal.fire({

        title: "¿Está seguro que desea eliminar este cliente?",
        text: "Si no está seguro de realizar esta acción puede cancelarla.",
        type: "warning",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, borrar cliente!'

    }).then((result) => {

        if (result.value) {

            window.location = "index.php?ruta=clientes&id_client=" + id_client + "";

        }

    })
    // 

})
