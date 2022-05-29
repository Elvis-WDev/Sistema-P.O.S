

/*=============================================
=      ACTIVAR BUTTON BUG FIX                   =
=============================================*/

$(document).ready(function () {

    value_estado_actual = $('btn_activar_user').attr('estado_tochange');

    if (value_estado_actual == 1) {

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estado_tochange', 1);

    } else {

        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activado');
        $(this).attr('estado_tochange', 0);

    }

})



/*=============================================
=      LIMPIAR MODAL REGISTER                   =
=============================================*/
$(document).on('click', ".btn_register_user", function () {

    $('.alert').remove();
    $(".txt_resgitrar_nombre").val("");
    $("#txt_register_user-Usuario").val("");
    $(".txt_register_password").val("");
    $("#INP-files-user-foto").val("");
    $(".prev_img").attr("src", 'views/img/img_users/default/anonymous.png');

});

/*=============================================
=                   SUBIR FOTO Y MOSTRAR                   =
=============================================*/

$('.inp-select-file').change(function () {

    var imagen = this.files[0];

    // Validamos el formato del IMG

    if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png"
        && imagen['type'] != "image/jpg") {

        $(".inp-select-file").val(""); //Borramos la foto.

        Swal.fire({
            title: "Error al subir la imagen.",
            text: "¡La Imagen debe estar en formato JPG, PNG O JPEG!",
            type: "error",
            icon: "error",
            confirmButtonText: "Cerrar",
            confirmButtonColor: "#FF2525"
        });

    } else if (imagen['size'] > 2000000) {

        $(".inp-select-file").val(""); //Borramos la foto.

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

            $(".prev_img").attr("src", urlImagen);

        })

    }

})

/*=============================================
=                       EDITAR USUARIO                   =
=============================================*/

$(document).on('click', ".btn_editar_user", function () {

    // Vacío los campos antes de traer nueva info.
    $("#txt_edit_user-name").val("");
    $("#txt_edit_user-usuario").val("");
    $("#txt_edit_user-password").val("");
    $(".inp-select-file").val("");
    $("#INP-files-user-foto").val("");
    $(".prev_img").attr('src', 'views/img/img_users/default/anonymous.png');

    var id_user = $(this).attr("data-id-usuario");

    var data = new FormData();
    data.append("id_usuario", id_user);

    $.ajax({

        url: "ajax/usuarios-ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#txt_edit_user-name").val(respuesta["nombre_usuario"]);
            $("#txt_edit_user-usuario").val(respuesta["usuario"]);

            if (respuesta["perfil_usuario"] == 'Administrador') {

                $("#cmbx_editar_user-perfil").html('<option value="Administrador" selected>Administrador</option><option value="Especial">Especial</option><option value="Vendedor">Vendedor</option>');

            } else if (respuesta["perfil_usuario"] == 'Especial') {

                $("#cmbx_editar_user-perfil").html('<option value="Administrador">Administrador</option><option value="Especial" selected>Especial</option><option value="Vendedor">Vendedor</option>');

            } else if (respuesta["perfil_usuario"] == 'Vendedor') {

                $("#cmbx_editar_user-perfil").html('<option value="Administrador">Administrador</option><option value="Especial">Especial</option><option value="Vendedor" selected>Vendedor</option>');

            }

            if (respuesta["foto_usuario"] != '') {

                $(".prev_img").attr('src', respuesta["foto_usuario"]);

            }

            $("#txt_hidden_password_actual").val(respuesta["password_usuario"]);

            $("#inp-foto_actual").val(respuesta["foto_usuario"]);






        }

    });

});


/*=============================================
=           Activar usuario                   =
=============================================*/

$(document).on('click', ".btn_activar_user", function () {

    var usuarioValueID = $(this).attr("id_value");
    var estadoAcambiar = $(this).attr("estado_tochange");


    var data = new FormData();
    data.append("activar_id", usuarioValueID);
    data.append("usuarioEstadoToChange", estadoAcambiar);

    $.ajax({

        url: "ajax/usuarios-ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

            if (respuesta) {

                window.location = 'usuarios';

            }

        }

    });



});


/*=============================================
=                   VALIDAR QUE USUARIO NO SEA REPETIDO                   =
=============================================*/

$('#txt_register_user-Usuario').change(function () {

    $('.alert').remove();

    var usuario_value = $(this).val();

    var data = new FormData();
    data.append("validar_user_value", usuario_value);

    $.ajax({

        url: "ajax/usuarios-ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (respuesta) {

                console.log(respuesta);

                $('#txt_register_user-Usuario').parent().before('<div class="alert alert-warning">Usuario ya registrado en la base de datos, ingrese otro usuario.</div>');

                $('#txt_register_user-Usuario').val("");


            }

        }

    });



});

/*=============================================
=       Eliminar usuario                =
=============================================*/

$(document).on('click', ".btn_DeleteUser", function () {

    data_id_usuario = $(this).attr('data-id-usuario');
    url_img = $(this).attr('data-url_img');
    user = $(this).attr('data-user');

    Swal.fire({

        title: "¿Está seguro que desea eliminar este usuario?",
        text: "Si no está seguro de realizar esta acción puede cancelarla.",
        type: "warning",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, borrar usuario!'

    }).then((result) => {

        if (result.value) {

            window.location = "index.php?ruta=usuarios&id_user=" + data_id_usuario + "&user=" + user + "&img_url=" + url_img + "";

        }

    })





})