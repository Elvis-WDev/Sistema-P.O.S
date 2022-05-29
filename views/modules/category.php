<?php

  /*===============================================
  =VALIDAR QUE NO INGRESE POR URL SIN AUTORIZACION=
  =================================================*/

  if($_SESSION["perfil"] == "Vendedor"){

    echo '<script>

      window.location = "home";

    </script>';

    return;

  }

?>

<!--===============================================
=INICIO DE PAGINA CATEGORIA=
=================================================-->

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <strong class="title_pages">Administrar Categoría</strong>

        </h1>

        <ol class="breadcrumb">

            <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrar Categoría</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAgregarCategory'>

                    <i class="fas fa-plus-square"></i> Agregar categoría

                </button>

            </div>

            <div class="box-body">

                <!--===============================================
                =TABLA NO DINAMICA=
                =================================================-->

                <table style='border-bottom:none !important;'
                    class='table table-bordered table-striped dt-responsive tablas tableCategory'>

                    <thead>

                        <tr>

                            <th style='border-bottom:none !important;'>#</th>
                            <th style='border-bottom:none !important;'>Categoría</th>
                            <th style='border-bottom:none !important;'>Fecha de Creación</th>
                            <th style='border-bottom:none !important;'>Acción</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                          /*===============================================
                          =LLENO MI TABLA CONECTANDO CON MI CONTROLADOR=
                          =================================================*/
          
                          $column = null;
                          $value = null;

                          $categorias = ControllerCategory::ctl_MostrarCategory($column, $value);

                          foreach($categorias as $key => $value){

                            /*=============================================
                            =PERMISOS PARA CATEGORIAS=
                            =============================================*/
                            
                            if($_SESSION["perfil"] == "Administrador"){

                              $btnDelete = '<button class="btn btn-danger btn_EliminarCategory" data-id-categoryDelete="'.$value["id_category"].'"><i class="fa fa-times"></i></button>'; 

                            }else{

                              $btnDelete = "";

                            }

                            echo '
                            
                              <tr>

                                <td style= "text-align:center;">'.($key+1).'</td>
                                <td class="text-uppercase" style= "text-align:center;">'.$value["categoria"].'</td>
                                <td style= "text-align:center;">'.$value["fecha"].'</td>
                                <td>

                                  <div style="display:flex;justify-content:center; text-align:center;" class="btn-group d-grid gap-2 d-md-block">

                                    <button class="btn btn-warning btn_editarCategory" style="color:#E1E1E1;" data-id-category="'.$value["id_category"].'" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>
                                    '.$btnDelete.'
                                    
                                  </div>

                                </td>

                              </tr>

                            ';

                          }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=============================================
=MODAL AGREGAR CATEGORY=
=============================================-->

<div class="modal fade" id="modalAgregarCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">

            <form role='form' method='POST' enctype='multipart/form-data'>

                <!--/*=============================================
                  =CABECERA DEL MODAL=
                  =============================================*/-->

                <div class="modal-header" style="background-color:#367fa9">

                    <h4 class="modal-title" id="staticBackdropLabel" style="color:#f4f4f4"><i class="fas fa-list"
                            style="font-size:20px"></i>
                        Registro de categoría
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!--/*=============================================
                  =CUERPO DEL MODAL=
                  =============================================*/-->

                <div class="modal-body">

                    <!--/*=============================================
                  =ENTRADA PARA CATEGORIA=
                  =============================================*/-->

                    <div class="input-group input-group-lg mb-3">

                        <span class='input-group-text' id="inputGroup-sizing-default"><i class='fa fa-list'></i></span>

                        <input type="text" class='form-control input-lg' placeholder='Ingresar categoría'
                            name='txt_register_category' aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" required>

                    </div>

                </div>

                <!--/*=============================================
                  =PIE DEL MODAL=
                  =============================================*/-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>
                    <button type='submit' class='btn btn-primary'><i class="fas fa-plus-square"></i>
                        Agregar categoría</button>

                </div>

            </form>

            <?php
  
              /*=================================================================
              =OBEJETO QUE CONECTA CON MI CONTRLADOR PARA REGISTRAR CATEGORIA=
              =================================================================*/

              $crearCategoria = new ControllerCategory();
              $crearCategoria -> ctl_CrearCategoria();

            ?>

        </div>

    </div>

</div>



<!--=============================================
=MODAL EDITAR CATEGORY=
=============================================-->

<div class="modal fade" id="modalEditarCategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">

            <form role='form' method='POST' enctype='multipart/form-data'>

                <!--=============================================
                =CABECERA MODAL=
                =============================================-->

                <div class="modal-header" style="background-color:#e08e0b">

                    <h4 class="modal-title" id="staticBackdropLabel" style="color:#f4f4f4"><i class="fas fa-list"
                            style="font-size:20px"></i>
                        Editar categoría
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!--=============================================
                =CUERPO MODAL=
                =============================================-->

                <div class="modal-body">

                    <!--/*=============================================
                  =ENTRADA PARA CATEGORIA=
                  =============================================*/-->
                    <div class="input-group input-group-lg mb-3">

                        <span class='input-group-text' id="inputGroup-sizing-default"><i class='fa fa-th'></i></span>
                        <input type="text" class='form-control input-lg' placeholder='Ingresar categoría'
                            id='txt_edit_category' name='txt_edit_category' aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" required>
                        <input type="hidden" name="txt_edit_id_catgory" id="txt_edit_id_catgory">

                    </div>


                </div>

                <!--=============================================
                =PIE MODAL=
                =============================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>
                    <button type='submit' class='btn btn-warning' style="color:#f4f4f4;"><i class="fas fa-check"></i>
                        Guardar
                        Cambios</button>

                </div>

            </form>

            <?php
              
              /*======================================================================
              =OBJETO NECESARIO QUE CONECTA CON MI CONTROLADOR PARA EDITAR CATEGORIA=
              ======================================================================*/
              
              $crearCategoria = new ControllerCategory();
              $crearCategoria -> ctl_EditarCategoria();

            ?>

        </div>

    </div>

</div>

<?php

  /*=======================================================================
  =OBJETO NECESARIO QUE CONECTA CON MI CONTROLADOR PARA ELIMINAR CATEGORIA=
  ========================================================================*/
              
  $BorrarCategoria = new ControllerCategory();
  $BorrarCategoria -> ctl_EliminarCategoria();

?>