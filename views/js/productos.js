


/*=============================================
=  CARGAR LA TABLA DINAMICA DE PRODUCTOS                   =
=============================================*/

$('.tableProductos').DataTable({
    "ajax": "ajax/datatable-productos_ajax.php",
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
=ASIGNANDO CÓDIGO A PARTIR DE SU CATEGORÍA                   =
=============================================*/

$("#cmbx_categoria_selected").change(function () {

    var id_categoria = $(this).val();

    var data = new FormData();
    data.append('category_id', id_categoria);

    cmbx_val = $("#cmbx_categoria_selected").val();

    $.ajax({

        url: "ajax/productos-ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (respuesta) {

            if (!respuesta) {

                var newCode = id_categoria + "01";
                $('#txt_code_register').val(newCode);

            } else {

                var newCode = Number(respuesta['codigo_producto']) + 1;
                $('#txt_code_register').val(newCode);

            }

        }

    })

});

/*=============================================
=      LIMPIAR MODAL REGISTER                   =
=============================================*/

$(document).on('click', "button.btn_AgregarProducto", function () {

    /*=============================================
    =LIMPIO MIS CAMPOS DE IMAGEN PARA EVITAR BUG FIX=
    =============================================*/

    $(".file_inp_producto").val('');
    $(".prev-img").attr("src", "views/img/img_products/default/anonymous.png");

});

/*=====================================================
=AGREGANDO PRECIO DE VENTA A PARTIR DE PRECIO COMPRA=
=====================================================*/

$('#txt_register_product-PrecioCompra, #txt_edit_product-PrecioCompra').keypress(cacularPrecioVenta);
$('#txt_register_product-PrecioCompra, #txt_edit_product-PrecioCompra').keyup(cacularPrecioVenta);
$('#txt_register_product-PrecioCompra, #txt_edit_product-PrecioCompra').change(cacularPrecioVenta);
$('.int-porcentaje-nuevo').keypress(cacularPrecioVenta);
$('.int-porcentaje-nuevo').keyup(cacularPrecioVenta);
$('.int-porcentaje-nuevo').change(cacularPrecioVenta);
$('.int-porcentaje-edit').keypress(cacularPrecioVenta);
$('.int-porcentaje-edit').keyup(cacularPrecioVenta);
$('.int-porcentaje-edit').change(cacularPrecioVenta);


function cacularPrecioVenta() {

    if ($("#checkbox_percent").prop("checked")) {

        /*=============================================
        =CALCULO PARA FORMULARIO DE REGISTRAR=
        =============================================*/

        var ValuePercent = $('.int-porcentaje-nuevo').val();

        var precioCompra = $('#txt_register_product-PrecioCompra').val();

        var precioVenta = Number(precioCompra) * Number(ValuePercent) / 100 + Number(precioCompra);

        $('#txt_register_product-PrecioVenta').val(precioVenta);
        $('#txt_register_product-PrecioVenta').prop('readonly', true);

        /*=============================================
        =CALCULO PARA FORMULARIO DE EDITAR=
        =============================================*/

        var ValuePercentE = $('.int-porcentaje-edit').val();

        var precioCompraEdit = $('.txt_edit_product-PrecioCompra').val();

        var precioVentaEdit = Number(precioCompraEdit) * Number(ValuePercentE) / 100 + Number(precioCompraEdit);

        $('#txt_edit_product-PrecioVenta').val(precioVentaEdit);
        $('#txt_edit_product-PrecioVenta').prop('readonly', true);

    }


}

$('.porcentaje').on('ifUnchecked', function (event) {

    $('#txt_register_product-PrecioVenta').prop('readonly', false);
    $('#txt_edit_product-PrecioVenta').prop('readonly', false);

});

$('.porcentaje').on('ifChecked', function (event) {

    $('#txt_register_product-PrecioVenta').prop('readonly', true);
    $('#txt_edit_product-PrecioVenta').prop('readonly', true);

});

/*=============================================
=       SUBIR FOTO Y MOSTRAR PRODUCTOS                   =
=============================================*/

$('.file_inp_producto').change(function () {

    var imagen = this.files[0];

    // Validamos el formato del IMG

    if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png"
        && imagen['type'] != "image/jpg") {

        $("#file_inp_producto").val(""); //Borramos la foto.

        Swal.fire({

            title: "Error al subir la imagen.",
            text: "¡La Imagen debe estar en formato JPG, PNG O JPEG!",
            type: "error",
            icon: "error",
            confirmButtonText: "Cerrar",
            confirmButtonColor: "#FF2525"

        });

    } else if (imagen['size'] > 2000000) {

        $(".file_inp_producto").val(""); //Borramos la foto.

        Swal.fire({

            title: "Error al subir la imagen.",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            icon: "error",
            confirmButtonText: "Cerrar",
            confirmButtonColor: "#FF2525"

        });

    } else {

        var imgData = new FileReader;
        imgData.readAsDataURL(imagen);

        $(imgData).on("load", function (event) {

            var urlImagen = event.target.result;

            $(".prev-img").attr("src", urlImagen);

        })

    }

})

/*=============================================
=                   EDITAR PRODUCTO                   =
=============================================*/

$('.tableProductos tbody').on('click', 'button.btn_EditarProducto', function () {

    /*=============================================
    =LIMPIO MIS CAMPOS DE IMAGEN PARA EVITAR BUG FIX=
    =============================================*/

    $(".file_inp_producto").val('');
    $(".prev-img").attr("src", "views/img/img_products/default/anonymous.png");

    var id_product = $(this).attr('id-producto_editar');

    var data = new FormData();
    data.append('idProducto', id_product);

    $.ajax({

        url: 'ajax/productos-ajax.php',
        method: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (respuesta) {

            var dataCat = new FormData();

            dataCat.append('id_category', respuesta['id_category']);

            $.ajax({

                url: 'ajax/category-ajax.php',
                method: 'POST',
                data: dataCat,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (respuestaCAT) {

                    $('#cmbx_categoria_selected_edit').val(respuestaCAT['id_category']);
                    $('#cmbx_categoria_selected_edit').html(respuestaCAT['categoria']);


                }

            });

            $('#txt_code_edit').val(respuesta['codigo_producto']);

            $('#txt_edit_product-descripcion').val(respuesta['descripcion_producto']);

            $('#txt_edit_product-stock').val(respuesta['stock_producto']);

            $('#txt_edit_product-PrecioCompra').val(respuesta['precio_compra_producto']);

            $('#txt_edit_product-PrecioVenta').val(respuesta['precio_venta_producto']);

            if (respuesta['url_img_producto'] != '') {

                $('#imagen_default').val(respuesta['url_img_producto']);

                $('.prev-img').attr('src', respuesta['url_img_producto']);

            }


        }

    })

});

/*=============================================
=                   DELETE PRODUCTO=
=============================================*/

$('.tableProductos tbody').on('click', 'button.btn_DeleteProducto', function () {

    var id_product = $(this).attr('id-producto-delete');
    var codigo_prod = $(this).attr('data-codigo_producto');
    var url_img = $(this).attr('data-url_img');

    Swal.fire({

        title: "¿Está seguro que desea eliminar este usuario?",
        text: "Si no está seguro de realizar esta acción puede cancelarla.",
        type: "warning",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, borrar producto!'

    }).then((result) => {

        if (result.value) {

            window.location = "index.php?ruta=productos&id_prod=" + id_product + "&cod_prod=" + codigo_prod + "&img_url=" + url_img + "";

        }

    })

});