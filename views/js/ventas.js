
/*=============================================
=VARIABLE DATERANGEPICKER LOCALSTORAGE=
=============================================*/

if (localStorage.getItem("capturarRango") != null) {

    $("#daterange-btn span").html(localStorage.getItem("capturarRango"));

} else {

    $("#daterange-btn span").html("<i class='fa fa-calendar'></i> Rango de fecha");

}

/*=============================================
=CARGAR JSON Y REVISION=
=============================================*/

var fechaIni = $('.inp_rangoTableFecha').attr('data-fechaIni');
var fechaFin = $('.inp_rangoTableFecha').attr('data-fechaFin');

var data = new FormData();
data.append('fecha_ini', fechaIni);
data.append('fecha_fin', fechaFin);


$.ajax({

    url: 'ajax/datatable-ventas_ajax.php',
    method: 'POST',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (respuesta) {

        var objJson = JSON.parse(respuesta);

        $('.table_section').append(
            "<table style='border-bottom:none !important;' class='table table-bordered table-striped dt-responsive TablaVentas'>" +

            "<thead>" +

            "<tr>" +

            "<th style='border-bottom:none !important;'>#</th>" +
            "<th style='border-bottom:none !important;'>Código de factura</th>" +
            "<th style='border-bottom:none !important;'>Cliente</th>" +
            "<th style='border-bottom:none !important;'>Vendedor</th>" +
            "<th style='border-bottom:none !important;'>Forma de pago</th>" +
            "<th style='border-bottom:none !important;'>Impuesto</th>" +
            "<th style='border-bottom:none !important;'>Neto</th>" +
            "<th style='border-bottom:none !important;'>Total</th>" +
            "<th style='border-bottom:none !important;'>Fecha</th>" +
            "<th style='border-bottom:none !important;'>Acciones</th>" +

            "</tr>" +

            "</thead>" +

            "<tbody class='body_table'>" +

            "</tbody>" +

            "</table>"
        );

        if (objJson["data"][0][0] == "NON-DATA") {

            // $('.body_table').append("<tr class='odd'><td valign='top' colspan='10' class='dataTables_empty'>No se encontraron resultados</td></tr>");

        } else {

            for (var indice in objJson) {

                for (var i in objJson[indice]) {

                    $('.body_table').append(
                        '<tr class="row' + i + '"></tr >'
                    )

                    $('.body_table .row' + i + '').append(

                        '<td>' + objJson[indice][i][0] + '</td>' +
                        '<td>' + objJson[indice][i][1] + '</td>' +
                        '<td>' + objJson[indice][i][2] + '</td>' +
                        '<td>' + objJson[indice][i][3] + '</td>' +
                        '<td>' + objJson[indice][i][4] + '</td>' +
                        '<td>' + objJson[indice][i][5] + '</td>' +
                        '<td>' + objJson[indice][i][6] + '</td>' +
                        '<td>' + objJson[indice][i][7] + '</td>' +
                        '<td>' + objJson[indice][i][8] + '</td>' +
                        '<td>' + objJson[indice][i][9] + '</td>'


                    )

                }

            }

            /*=============================================
            =EDITAR VENTA Y PASAR ID POR GET=
            =============================================*/

            $('.TablaVentas').on('click', 'button.btn_EditarVenta_adm', function () {

                var idVenta = $(this).attr('id_venta');

                window.location = 'index.php?ruta=editar-venta&id_venta=' + idVenta;

            })

            /*=============================================
            =ELIMINAR VENTAS=
            =============================================*/

            $('.TablaVentas').on('click', 'button.btn_EliminarVenta', function () {

                var Idventa = $(this).attr('id_Venta');

                Swal.fire({

                    title: "¿Está seguro que desea eliminar esta venta?",
                    text: "Si no está seguro de realizar esta acción puede cancelarla.",
                    type: "warning",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: '¡Sí, borrar venta!'

                }).then((result) => {

                    if (result.value) {

                        window.location = "index.php?ruta=ventas&id_venta=" + Idventa;

                    }

                })

            })

            /*=============================================
            =IMPRIMIR FACTURA=
            =============================================*/

            $('.TablaVentas').on('click', 'button.btn_ImprimirFactura', function () {

                var codigoVenta = $(this).attr('codigo_factura');
                window.open('extensions/TCPDF/PDF/Factura_Generada.php?codigoF=' + codigoVenta, '_blank')

            })

        }


        /*=============================================
           =TABLA VENTAS DE ADMINISTRACION=
           =============================================*/

        $('.TablaVentas').DataTable({
            "responsive": true,
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

    }

})





/*=============================================
=  CARGAR LA TABLA DINAMICA DE PRODUCTOS EN VENTAS=
=============================================*/

$('.TableVentas').DataTable({
    "ajax": "ajax/datatable-ventasProductos_ajax.php",
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
=AGREGAR PRODUCTO A LA VENTA DESDE TABLA=
=============================================*/

$('.TableVentas tbody').on('click', 'button.btnAgregarProducto', function () {

    var id_producto = $(this).attr('data-id-product');

    $(this).removeClass('btnAgregarProducto');
    $(this).prop('disabled', true);

    var data = new FormData();
    data.append('idProducto', id_producto);

    $.ajax({

        url: 'ajax/productos-ajax.php',
        method: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (respuesta) {

            var descripcion = respuesta['descripcion_producto'];
            var stock = respuesta['stock_producto'];
            var precio = respuesta['precio_venta_producto'];

            /*=============================================
            =EVITAR AGREGAR PRODUCTO SI STOCK ES 0=
            =============================================*/

            if (stock == 0) {


                Swal.fire({

                    title: "¡No hay stock disponible para este producto!",
                    type: "error",
                    icon: 'error',
                    confirmButtonText: 'Ok'

                })

                $('button.btn-RecuperarButton[data-id-product="' + id_producto + '"]').prop('disabled', false);
                $('button.btn-RecuperarButton[data-id-product="' + id_producto + '"]').addClass('btnAgregarProducto');

                return;

            }


            $('.div_nuevoProducto').append(
                " <div class='row mb-1' style='padding-right:0px'>" +

                "<div class= 'input-form col-6' style='padding-right:0px'>" +

                "<div class='input-group input-group-sm'>" +

                "<span class='input-group-text'>" +

                "<button type='button' class='btn btn-danger btn-sm btn_quitarProducto' data-id-product='" + id_producto + "'> <i class='fa fa-times'></i>" +
                "</button>" +
                "</span >" +

                "<input type='text' class='form-control txt_registrarVenta_nombreProducto' data-id-product='" + id_producto + "' name='txt_registrarVenta_nombreProducto' id='txt_registrarVenta_nombreProducto' placeholder='Descripción del producto' value='" + descripcion + "' readonly required>" +

                "</div>" +

                "</div>" +

                "<div class='col-3 cantidadIngreso'>" +

                "<div class='input-group input-group-sm'>" +

                "<input type='number' class='form-control form-control-lg txt_registrarVenta_cantidadProducto' name='txt_registrarVenta_cantidadProducto' id='txt_registrarVenta_cantidadProducto' placeholder='0' min='1' max='" + stock + "' value='1' newStock='" + Number(stock - 1) + "' stock='" + stock + "' required>" +

                "</div>" +

                "</div>" +

                "<div class='col-3 precioIngreso' style='padding-left:0px'>" +

                "<div class='input-group'>" +

                "<span class='input-group-text'><i class='ion ion-social-usd'></i></span>" +

                "<input type='text' class='form-control txt_registrarVenta_precioProducto' name='txt_registrarVenta_precioProducto' data-precioIni='" + precio + "' id='txt_registrarVenta_precioProducto' placeholder='0.00' min='1' value='" + precio + "' readonly required>" +

                "</div>" +

                "</div>" +

                "</div>"
            );

            /*=============================================
            =   SUMMAR TOTAL DE PRECIOS=
            =============================================*/

            SumarTotalPrecios();

            /*=============================================
            =   AGREGAR IMPUESTO =
            =============================================*/

            AgregarImpuesto();

            /*=============================================
            =AGREGAR PRODUCTOS A JSON=
            =============================================*/

            listarProductos();

            /*=============================================
            =FORMATO DE LOS PRECIOS PRODUCTOS=
            =============================================*/

            $('.txt_registrarVenta_precioProducto').number(true, 2);

            /*========================================================
            =ELIMINO MI VARIABLE LOCAR STORAGE AL AGREGAR UN PRODUCTO=
            ==========================================================*/

            localStorage.removeItem("quitarProduct");

        }

    })

});

/*=============================================
=QUITAR PRODUCTOS DE LA VENTA CON LOCALSTORAGE=
=============================================*/

$('.TableVentas').on('draw.dt', function () {

    if (localStorage.getItem('quitarProduct') != null) {

        var listIdproduct = JSON.parse(localStorage.getItem('quitarProduct'));

        console.log(listIdproduct);

        for (var i = 0; i < listIdproduct.length; i++) {

            $('button.btn-RecuperarButton[data-id-product="' + listIdproduct[i]['id-producto'] + '"]').prop('disabled', false);
            $('button.btn-RecuperarButton[data-id-product="' + listIdproduct[i]['id-producto'] + '"]').addClass('btnAgregarProducto');

        }

    }

    quitarAgregarProducto();

})

/*=============================================
=QUITAR PRODUCTOS DE LA VENTA=
=============================================*/
var idQuitarPeduct = [];

localStorage.removeItem('quitarProduct');

$('.formVenta').on('click', 'button.btn_quitarProducto', function () {

    $(this).parent().parent().parent().parent().remove();

    var id_pro = $(this).attr('data-id-product');

    /*=======================================================
    =ALMACENAR EN LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR=
    =========================================================*/

    if (localStorage.getItem('quitarProduct') == null) {

        idQuitarPeduct = [];

    } else {

        idQuitarPeduct.concat(localStorage.getItem('quitarProduct'));

    }

    idQuitarPeduct.push({ 'id-producto': id_pro });

    localStorage.setItem('quitarProduct', JSON.stringify(idQuitarPeduct));

    $('button.btn-RecuperarButton[data-id-product="' + id_pro + '"]').prop("disabled", false);
    $('button.btn-RecuperarButton[data-id-product="' + id_pro + '"]').addClass('btnAgregarProducto');

    if ($('.div_nuevoProducto').children().length == 0) {

        $('.txt_registrarVenta_NuevoImpuestoVenta').val(12);

        $('.txt_registrarVenta_NuevoTotalVenta').val(0);

        $('#txt_registrarVentaHD_NuevoTotalVenta').val(0);

        $('.txt_registrarVenta_NuevoTotalVenta').attr('data-totalprecio', 0);

    } else {

        /*=============================================
        =   SUMMAR TOTAL DE PRECIOS=
        =============================================*/

        SumarTotalPrecios();

        /*=============================================
        =   AGREGAR IMPUESTO =
        =============================================*/

        AgregarImpuesto();

        /*=============================================
        =AGREGAR PRODUCTOS A JSON=
        =============================================*/

        listarProductos();

    }


});


/*=============================================
=AGREGANDO PRODUCTO PARA DISPOSITIVOS=
=============================================*/

var acumProducto = 0;

$('.btn_agregarProducto').click(function () {

    acumProducto++;

    var data = new FormData();
    data.append('TraerProductos', 'ok');

    $.ajax({

        url: 'ajax/productos-ajax.php',
        method: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (respuesta) {

            $('.div_nuevoProducto').append("<div class='row mb-2' style='padding-right:0px'>" +

                "<div class='col-lg-6 col-sm-5 col-md-6 col-xs-5 caja_select' style='padding-right:0px'>" +

                "<div class='input-group input-group-sm'>" +

                "<span class='input-group-text'>" +

                "<button type='button' class='btn btn-danger btn-sm btn_quitarProducto' data-id-producto=''>" +

                "<i class='fa fa-times'></i>" +

                "</button>" +

                "</span>" +

                "<select class='form-select cmbx_descripcionProducto_dispositivos txt_registrarVenta_nombreProducto' id='producto" + acumProducto + "' data-id-product name='cmbx_descripcionProducto_dispositivos' required>" +

                "<option value='no-selected'>-Seleccione el producto-</option>" +

                "</select>" +

                "</div>" +

                "</div>  " +

                "<div class='col-lg-3 col-sm-3 col-xs-3 col-md-2 cantidadIngreso'>" +

                "<input type='number' class='form-control txt_registrarVenta_cantidadProducto' name='txt_registrarVenta_cantidadProducto' id='txt_registrarVenta_cantidadProducto' placeholder='0' min='1' max='' value='1' newStock stock='' readonly required>" +

                "</div>" +

                "<div class='col-lg-3 col-sm-4 col-xs-4 col-md-4 precioIngreso' style='padding-left:0px'>" +

                "<div class='input-group este'>" +

                "<span class='input-group-text'><i class='ion ion-social-usd'></i></span>" +

                "<input type='text' class='form-control txt_registrarVenta_precioProducto' name='txt_registrarVenta_precioProducto' data-precioIni='' id='txt_registrarVenta_precioProducto' placeholder='0.00' min='1' value='' readonly required>" +

                "</div>" +

                "</div>" +

                "</div>");

            /*=============================================
            =AGREGAR PRODUCTO AL SELECT=
            =============================================*/

            respuesta.forEach(funcionForEach);

            function funcionForEach(item, index) {

                if (item.stock_producto != 0) {

                    $('#producto' + acumProducto).append(

                        '<option data-id-product="' + item.id_producto + '" value="' + item.descripcion_producto + '">' + item.descripcion_producto + '</option>'

                    );

                } else {

                    $('#producto' + acumProducto).append(

                        '<option value="" style="color:#afafaf;" disabled> (AGOTADO) ' + item.descripcion_producto + '</option>'

                    );

                }


            }

            /*=============================================
            =   SUMMAR TOTAL DE PRECIOS=
            =============================================*/

            SumarTotalPrecios();

            /*=============================================
            =   AGREGAR IMPUESTO =
            =============================================*/

            AgregarImpuesto();

            /*=============================================
            =FORMATO DE LOS PRECIOS PRODUCTOS=
            =============================================*/

            $('.txt_registrarVenta_precioProducto').number(true, 2);


        }


    })

});

/*=============================================
=SELECCIONAR PRODUCTO DISPOSITIVOS=
=============================================*/

$('.formVenta').on('change', 'select.cmbx_descripcionProducto_dispositivos', function () {

    var NameProducto = $(this).val();

    var precioVentaProducto = $(this).parent().parent().parent().children('.precioIngreso').children().children('.txt_registrarVenta_precioProducto');

    var CantidadProducto = $(this).parent().parent().parent().children('.cantidadIngreso').children('.txt_registrarVenta_cantidadProducto');

    if ($(this).val() == "no-selected") {

        $(precioVentaProducto).val("");
        $(CantidadProducto).val(1);
        $(precioVentaProducto).prop('readonly', true);
        $(CantidadProducto).prop('readonly', true);

    } else {

        var data = new FormData();
        data.append('NombreProducto', NameProducto);

        $.ajax({

            url: 'ajax/productos-ajax.php',
            method: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (respuesta) {

                $(".txt_registrarVenta_nombreProducto").attr("data-id-product", respuesta["id_producto"]);
                $(CantidadProducto).attr("stock", respuesta['stock_producto']);
                $(CantidadProducto).attr("newStock", Number(respuesta['stock_producto'] - 1));
                $(CantidadProducto).attr("max", respuesta['stock_producto']);
                $(precioVentaProducto).val(respuesta['precio_venta_producto']);
                $(precioVentaProducto).attr('data-precioIni', respuesta['precio_venta_producto']);

                /*=============================================
                =   SUMMAR TOTAL DE PRECIOS=
                =============================================*/

                SumarTotalPrecios();

                /*=============================================
                =   AGREGAR IMPUESTO =
                =============================================*/

                AgregarImpuesto();

                /*=============================================
                =AGREGAR PRODUCTOS A JSON=
                =============================================*/

                listarProductos();

                /*=============================================
                =FORMATO DE LOS PRECIOS PRODUCTOS=
                =============================================*/

                $('.txt_registrarVenta_precioProducto').number(true, 2);

                /*=============================================
                =ACTIVO LA CAJA PARA SU RESPECTIVA EDICION=
                =============================================*/

                $(CantidadProducto).prop('readonly', false);

            }

        })


    }


})

/*=============================================
=ENTRADA DE PRODUCTO DINAMICO=
=============================================*/

$('.formVenta').on('keyup', 'input.txt_registrarVenta_cantidadProducto', ValidarProductoProceso);
$('.formVenta').on('change', 'input.txt_registrarVenta_cantidadProducto', ValidarProductoProceso);
$('.formVenta').on('keypress', 'input.txt_registrarVenta_cantidadProducto', ValidarProductoProceso);

function ValidarProductoProceso() {

    var precioProducto = $(this).parent().parent().parent().children('.precioIngreso').children().children('.txt_registrarVenta_precioProducto');

    var precioFinal = $(this).val() * precioProducto.attr('data-precioIni');

    precioProducto.val(precioFinal);

    var newStock = Number($(this).attr('stock')) - Number($(this).val());

    $(this).attr('newStock', newStock);
    // 
    if (Number($(this).val()) > Number($(this).attr('stock'))) {

        $(this).val(1);

        Swal.fire({

            title: "¡La cantidad supera el stock!",
            text: "¡Solo hay " + $(this).attr('stock') + " unidades para este producto!",
            type: "error",
            icon: 'error',
            confirmButtonText: 'Ok'

        })

    }

    /*=============================================
    =   SUMMAR TOTAL DE PRECIOS=
    =============================================*/

    SumarTotalPrecios();

    /*=============================================
    =   AGREGAR IMPUESTO =
    =============================================*/

    AgregarImpuesto();

    /*=============================================
    =AGREGAR PRODUCTOS A JSON=
    =============================================*/

    listarProductos();

    /*=============================================
    =FORMATO DE LOS PRECIOS PRODUCTOS=
    =============================================*/

    $('.txt_registrarVenta_precioProducto').number(true, 2);


}


/*=============================================
=SUMAR TODOS LOS PRODUCTOS PRECIOS=
=============================================*/

function SumarTotalPrecios() {

    var PrecioItem = $('.txt_registrarVenta_precioProducto');
    var ArraySumaPrecio = [];

    for (var i = 0; i < PrecioItem.length; i++) {

        ArraySumaPrecio.push(Number($(PrecioItem[i]).val()));

    }

    function SumaArrayPrecios(total, numero) {

        return total + numero;

    }

    var SumaTotalPrecio = ArraySumaPrecio.reduce(SumaArrayPrecios);

    $('.txt_registrarVenta_NuevoTotalVenta').val(SumaTotalPrecio);

    $('#txt_registrarVentaHD_NuevoTotalVenta').val(SumaTotalPrecio);

    $('.txt_registrarVenta_NuevoTotalVenta').attr('data-totalprecio', SumaTotalPrecio);


}

/*=============================================
=FUNCTION AGREGAR IMPUESTO=
=============================================*/

function AgregarImpuesto() {

    var impuesto = $('.txt_registrarVenta_NuevoImpuestoVenta').val();

    var PrecioVentaTotal = $('.txt_registrarVenta_NuevoTotalVenta').attr('data-totalprecio');

    var precioImpuesto = Number(PrecioVentaTotal * impuesto / 100);

    var TotalConImpuesto = Number(precioImpuesto) + Number(PrecioVentaTotal);

    $('.txt_registrarVenta_NuevoTotalVenta').val(TotalConImpuesto);

    $('#txt_registrarVentaHD_NuevoTotalVenta').val(TotalConImpuesto);

    $('#txt_registrarVenta_PrecioImpuestoAguardar').val(precioImpuesto);

    $('#txt_registrarVenta_PrecioImpuestoNetoAguardar').val(PrecioVentaTotal);

}

/*=============================================
=IMPUESTO DINAMICO QUE CAMBIA=
=============================================*/

$('.txt_registrarVenta_NuevoImpuestoVenta').keyup(AgregarImpuesto);
$('.txt_registrarVenta_NuevoImpuestoVenta').keypress(AgregarImpuesto);
$('.txt_registrarVenta_NuevoImpuestoVenta').change(AgregarImpuesto);

/*=============================================
=FORMATO AL INPUT TOTAL=
=============================================*/

$('.txt_registrarVenta_NuevoTotalVenta').number(true, 2);

/*=============================================
=SELECCIONAR METODO DE PAGO=
=============================================*/


$('.cmbx_metodo_pago').change(function () {

    if ($(this).val() == 'Efectivo') {

        $(this).parent().parent().removeClass('col-lg-6');

        $(this).parent().parent().addClass('col-lg-6');

        $(this).parent().parent().parent().children('.CajasMetodoPago').html(

            '<div class="col-lg-6 m-0 div_Venta_Efectivo">' +

            '<div class="input-group m-0">' +

            '<span class="input-group-text"><i class="ion ion-social-usd"></i></span>' +
            '<input type="text" class="form-control txt_VentavalorEfectivo" placeholder="0.00" required>' +

            '</div>' +

            '</div>' +

            '<div class="col-lg-6 m-0 div_Venta_CambioEfectivo" style="padding-left:0px;">' +

            '<div class="input-group">' +

            '<span class="input-group-text"><i class="ion ion-social-usd"></i></span>' +
            '<input type="text" class="form-control txt_Venta_CambioEfectivo" placeholder="0.00" readonly required>' +

            '</div>' +

            '</div>'

        );

        /*=============================================
        =FOMATO PARA CAJAS EFECTIVO=
        =============================================*/

        $('.txt_VentavalorEfectivo').number(true, 2);
        $('.txt_Venta_CambioEfectivo').number(true, 2);

        /*=============================================
        =LISTAR METODO PAGO=
        =============================================*/

        ListarMetodoPago();

    } else if ($(this).val() == '') {

        $(this).parent().parent().parent().children('.CajasMetodoPago').html("");

    } else if ($(this).val() == 'TD') {

        $(this).parent().parent().removeClass('col-xs-4');

        $(this).parent().parent().addClass('col-xs-5');

        $(this).parent().parent().parent().children('.CajasMetodoPago').html(

            '<div class="col-xs-7">' +

            '<div class="form-group">' +

            '<div class="input-group">' +

            '<input type="text" class="form-control" name="txt_registrarVenta_NuevoCodigoTransaccion" id="txt_registrarVenta_NuevoCodigoTransaccion" placeholder="TD-Código Transacción" required>' +
            '<span class="input-group-text"><i class="fa fa-key"></i></span>' +

            '</div>' +

            '</div>' +

            '</div>'

        );

    } else if ($(this).val() == 'TC/TD') {

        $(this).parent().parent().removeClass('col-xs-4');

        $(this).parent().parent().addClass('col-xs-5');

        $(this).parent().parent().parent().children('.CajasMetodoPago').html(

            '<div class="col-xs-7">' +

            '<div class="form-group">' +

            '<div class="input-group">' +

            '<input type="text" class="form-control" name="txt_registrarVenta_NuevoCodigoTransaccion" value="TD-" id="txt_registrarVenta_NuevoCodigoTransaccion" placeholder="TC/TD-Código Transacción" required>' +
            '<span class="input-group-text"><i class="fa fa-key"></i></span>' +

            '</div>' +

            '</div>' +

            '</div>'

        );

    } else {

        $(this).parent().parent().removeClass('col-xs-4');

        $(this).parent().parent().addClass('col-xs-5');

        $(this).parent().parent().parent().children('.CajasMetodoPago').html(

            '<div class="col-xs-7">' +

            '<div class="form-group">' +

            '<div class="input-group">' +

            '<input type="text" class="form-control" name="txt_registrarVenta_NuevoCodigoTransaccion" id="txt_registrarVenta_NuevoCodigoTransaccion" placeholder="TC-Código Transacción" required>' +
            '<span class="input-group-text"><i class="fa fa-key"></i></span>' +

            '</div>' +

            '</div>' +

            '</div>'

        );

    }

})

/*=============================================
=CAMBIO EN EFECTIVO PARA EL METODO PAGO EFECTIVO=
=============================================*/
$('.formVenta').on('keyup', 'input.txt_VentavalorEfectivo', EfectivoMetodoPago);
$('.formVenta').on('keypress', 'input.txt_VentavalorEfectivo', EfectivoMetodoPago);
$('.formVenta').on('change', 'input.txt_VentavalorEfectivo', EfectivoMetodoPago);

function EfectivoMetodoPago() {

    var efectivo = $(this).val();

    var cambio = Number(efectivo) - Number($('.txt_registrarVenta_NuevoTotalVenta').val());

    var nuevoCambioEfectivo = $(this).parent().parent().parent().children('.div_Venta_CambioEfectivo').children().children('.txt_Venta_CambioEfectivo');

    nuevoCambioEfectivo.val(cambio);

}

/*=============================================
=CAMBIO TRANSACCION=
=============================================*/

$('.formVenta').on('keyup', 'input#txt_registrarVenta_NuevoCodigoTransaccion', CambioTransaccion);
$('.formVenta').on('keypress', 'input#txt_registrarVenta_NuevoCodigoTransaccion', CambioTransaccion);
$('.formVenta').on('change', 'input#txt_registrarVenta_NuevoCodigoTransaccion', CambioTransaccion);

function CambioTransaccion() {

    /*=============================================
    =LISTAR METODO PAGO=
    =============================================*/

    ListarMetodoPago();

}

/*=============================================
=LISTAR TODOS LOS PRODUCTOS=
=============================================*/

function listarProductos() {

    var listarProducts = [];

    // var id_product =

    var descripcion = $('.txt_registrarVenta_nombreProducto');

    var cantidad = $('.txt_registrarVenta_cantidadProducto');

    var precio = $('.txt_registrarVenta_precioProducto');

    // var total =

    for (var i = 0; i < descripcion.length; i++) {

        listarProducts.push({
            'id': $(descripcion[i]).attr('data-id-product'),
            'nombre': $(descripcion[i]).val(),
            'cantidad': $(cantidad[i]).val(),
            'stock': $(cantidad[i]).attr('newStock'),
            'precio': $(precio[i]).attr('data-precioIni'),
            'precioTotalProduct': $(precio[i]).val()
        });

    }

    $('#inp_listaProductos').val(JSON.stringify(listarProducts));

}

/*=============================================
=LISTAR METODO PAGO=
=============================================*/

function ListarMetodoPago() {

    var listaMetodo = [];

    if ($('.cmbx_metodo_pago').val() == 'Efectivo') {

        $('#inpHD_listaMetodoPago').val('Efectivo');

    } else if ($('.cmbx_metodo_pago').val() == "TC/TD") {

        $('#inpHD_listaMetodoPago').val($('#txt_registrarVenta_NuevoCodigoTransaccion').val());

    } else {

        $('#inpHD_listaMetodoPago').val($('.cmbx_metodo_pago').val() + '-' + $('#txt_registrarVenta_NuevoCodigoTransaccion').val());


    }

}

/*=============================================
=AGREGAR BOTTON RANGO DE FECHAS=
=============================================*/

$('#daterange-btn').daterangepicker(
    {
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate: moment()
    },
    function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        var fechaInicial = start.format('YYYY-MM-DD');

        var fechaFinal = end.format('YYYY-MM-DD');

        var capturarRango = $("#daterange-btn span").html();

        localStorage.setItem("capturarRango", capturarRango);

        window.location = "index.php?ruta=ventas&fecha_ini=" + fechaInicial + "&fecha_final=" + fechaFinal;

    }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .drp-buttons .cancelBtn").on("click", function () {

    localStorage.removeItem("capturarRango");
    localStorage.clear();
    window.location = "ventas";

})

/*=============================================
=SELEECIONAR FECHA HOY=
=============================================*/

$(".daterangepicker.opensleft .ranges ul li").on("click", function () {

    var textoHoy = $(this).attr("data-range-key");

    if (textoHoy == "Hoy") {

        var d = new Date();

        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();

        if (mes < 10) {

            var fechaInicial = año + "-0" + mes + "-" + dia;
            var fechaFinal = año + "-0" + mes + "-" + dia;

        } else if (dia < 10) {

            var fechaInicial = año + "-" + mes + "-0" + dia;
            var fechaFinal = año + "-" + mes + "-0" + dia;

        } else if (mes < 10 && dia < 10) {

            var fechaInicial = año + "-0" + mes + "-0" + dia;
            var fechaFinal = año + "-0" + mes + "-0" + dia;

        } else {

            var fechaInicial = año + "-" + mes + "-" + dia;
            var fechaFinal = año + "-" + mes + "-" + dia;

        }

        localStorage.setItem("capturarRango", "Hoy");

        window.location = "index.php?ruta=ventas&fecha_ini=" + fechaInicial + "&fecha_final=" + fechaFinal;

    }

})



/*=========================================================
=ARREGLO MI TABLA PARA EL DISENIO Y HAGA UN SALTO DE LINEA=
==========================================================*/

if (screen.width < 1285) {

    $(".card_crear_venta").removeClass("col-lg-5");
    $(".card_crear_venta").addClass("col-lg-12");

    $(".card_tabla_productosVentas").removeClass("col-lg-7");
    $(".card_tabla_productosVentas").addClass("col-lg-12");

}

/*=============================================
=VALIDO EL ENVIO DEL FORMULARIO SI NO HA SELECCIONADO PRODUCTOS=
=============================================*/

$(".formVenta").submit(function (e) {


    var validProductosNoselected = 0;

    $(".txt_registrarVenta_nombreProducto").each(function () {

        if ($(this).val() == "no-selected") {

            validProductosNoselected++;

        }

    });

    if (validProductosNoselected >= 1) {

        Swal.fire({

            title: "¡Producto sin seleccionar!",
            text: "¡Debe seleccionar el productos que desea agregar a la venta!",
            type: "warning",
            icon: 'warning',
            confirmButtonText: 'Ok'

        })

        e.preventDefault();

    } else {

        this.submit();

    }

});

/*======================================================================================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
========================================================================================================*/

function quitarAgregarProducto() {

    //Capturamos todos los id de productos que fueron elegidos en la venta
    var idProductos = $(".btn_quitarProducto");

    //Capturamos todos los botones de agregar que aparecen en la tabla
    var botonesTabla = $(".TableVentas tbody button.btnAgregarProducto");

    //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
    for (var i = 0; i < idProductos.length; i++) {

        //Capturamos los Id de los productos agregados a la venta
        var boton = $(idProductos[i]).attr("data-id-product");

        //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
        for (var j = 0; j < botonesTabla.length; j++) {

            if ($(botonesTabla[j]).attr("data-id-product") == boton) {

                $(botonesTabla[j]).prop('disabled', true);
                $(botonesTabla[j]).addClass('btnAgregarProducto');

            }
        }

    }

}









