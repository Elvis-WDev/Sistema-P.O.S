

$(document).ready(function () {

    /*=============================================
    =                   EDITAR CATEGORIAS                   =
    =============================================*/

    $(".tableCategory tbody").on("click", 'button.btn_editarCategory', function () {

        var id_category = $(this).attr('data-id-category');

        var data = new FormData();
        data.append('id_category', id_category);

        $.ajax({

            url: "ajax/category-ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {

                $('#txt_edit_category').val(respuesta['categoria']);
                $('#txt_edit_id_catgory').val(respuesta['id_category']);

            }

        })

    })

    /*=============================================
    =                   ELIMINAR CATEGORIAS                   =
    =============================================*/

    $('.tableCategory tbody').on("click", "button.btn_EliminarCategory", function () {

        var idCategory = $(this).attr('data-id-categoryDelete');

        Swal.fire({

            type: "warning",
            icon: "warning",
            title: "¿Está seguro que desea eliminar esta categoría?",
            text: '¡Si no está seguro puede cancelar esta acción!',
            showConfirmButton: true,
            confirmButtonColor: '#dd4b39',
            cancelButtonColor: "#337ab7",
            showCancelButton: true,
            confirmButtonText: "¡Sí, eliminar categoría!",
            closeOnConfirm: false

        }).then((result) => {

            if (result.value) {

                window.location = "index.php?ruta=category&id_Categoria=" + idCategory;

            }
        })

    });


})