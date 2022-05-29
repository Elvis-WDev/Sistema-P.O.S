<?php

  /*=============================================
  =VALIDO QUE NO ENTREN POR URL SIN AUTORIZACION=
  =============================================*/

  if($_SESSION["perfil"] == "Especial"){

    echo '<script>

      window.location = "home";

    </script>';

    return;

  }

?>

<!--/*=============================================
=INICIO PAGINA CLIENTE=
=============================================*/-->

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <strong class="title_pages">Administrar Clientes</strong>

        </h1>

        <ol class="breadcrumb">

            <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrar Clientes</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <!--/*=============================================
                =BOTON AGREGAR CLIENTE=
                =============================================*/-->

                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAgregarCliente'>

                    <i class="fas fa-plus-square"></i> Agregar cliente

                </button>


            </div>

            <div class="box-body">

                <!--/*=============================================
                =INICIO DE MI TABLA=
                =============================================*/-->

                <table style='border-bottom:none !important;'
                    class='table table-bordered table-striped dt-responsive tableClientes'>

                    <thead>

                        <tr>

                            <th style='border-bottom:none !important;text-align:center;'>#</th>
                            <th style='border-bottom:none !important;text-align:center;'>Nombre</th>
                            <th style='border-bottom:none !important;text-align:center;'>Documento</th>
                            <th style='border-bottom:none !important;text-align:center;'>E-mail</th>
                            <th style='border-bottom:none !important;text-align:center;'>Teléfono</th>
                            <th style='border-bottom:none !important;text-align:center;'>Dirección</th>
                            <th style='border-bottom:none !important;text-align:center;'>Fecha Nacimiento</th>
                            <th style='border-bottom:none !important;text-align:center;'>Total compras</th>
                            <th style='border-bottom:none !important;text-align:center;'>Última compra</th>
                            <th style='border-bottom:none !important;text-align:center;'>Ingreso al sistema</th>
                            <th style='border-bottom:none !important;text-align:center;'>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <!--/*=============================================
                        =TBODY DE CLIENTES QUE SE LLENA POR AJAX=
                        =============================================*/-->

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--/*=============================================
  =MODAL AGREGAR CLIENTE=
  =============================================-->

<div class="modal fade" id="modalAgregarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">

            <form role='form' method='POST' enctype='multipart/form-data'>

                <!--/*=============================================
                =CABECERA MODAL=
                =============================================*/-->

                <div class="modal-header" style="background-color:#367fa9">

                    <h4 class="modal-title" id="staticBackdropLabel" style="color:#f4f4f4"><i
                            class="fas fa-portrait"></i> Registro de clientes
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!--/*=============================================
                =CUERPO MODAL=
                =============================================*/-->

                <div class="modal-body">

                    <div class='box-body'>

                        <!--/*=============================================
                        =ENTRADA PARA NOMBRE=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-user-circle'></i></span>
                            <input type="text" class='form-control input-lg' placeholder='Ingresar Nombre'
                                name='txt_register_cliente_nombre' aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA CEDULA=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class="fas fa-address-card"></i></span>
                            <input type="number" class='form-control input-lg' min='0' placeholder='Ingresar cédula'
                                name='txt_register_cliente_document' aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA MAIL=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-envelope'></i></span>
                            <input type="email" class='form-control input-lg' placeholder='Ingresar E-mail'
                                name='txt_register_cliente_mail' aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA TELEFONO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-phone-square-alt'></i></span>
                            <input type="text" class='form-control input-lg' placeholder='Ingresar Teléfono' value='593'
                                name='txt_register_cliente_telefono' data-inputmask="'mask':'(+999) 99-999-9999'"
                                data-mask aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA DIRECCION=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-map-marker-alt'></i></span>
                            <input type="text" class='form-control input-lg' placeholder='Ingresar Dirección'
                                name='txt_register_cliente_direccion' aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA FECHA NACIMIENTO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-calendar-alt'></i></span>
                            <input type="text" class='form-control input-lg' placeholder='Ingresar fecha de nacimiento'
                                name='txt_register_cliente_fechaNacimiento' data-inputmask="'alias':'yyyy-mm-dd'"
                                data-mask aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                required>

                        </div>

                    </div>

                </div>

                <!--/*=============================================
                =PIE MODAL=
                =============================================*/-->

                <div class="modal-footer">

                    <!--/*=============================================
                    =BOTONES MODAL=
                    =============================================*/-->

                    <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>
                    <button type='submit' class='btn btn-primary'><i class="fas fa-plus-square"></i> Agregar
                        cliente</button>

                </div>

            </form>

            <?php
              
              /*=============================================
              =OBJETO QUE CONECTA PARA REGISTRO DEL CLIENTE=
              =============================================*/
              
              $crearCliente = new ControllerClientes();
              $crearCliente -> ctl_crearCLiente();
              
            ?>

        </div>

    </div>

</div>

<!--/*=============================================
  =MODAL EDITAR CLIENTE=
  =============================================-->

<div class="modal fade" id="modalEditarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">

            <form role='form' method='POST' enctype='multipart/form-data'>

                <div class="modal-header" style="background-color:#e08e0b">

                    <h4 class="modal-title" id="staticBackdropLabel" style="color:#f4f4f4"><i
                            class="fas fa-portrait"></i> Editar cliente
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class='box-body'>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA NOMBRE=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-user-circle'></i></span>
                            <input type="text" class='form-control input-lg' placeholder='Ingresar Nombre'
                                id='txt_edit_cliente_nombre' name='txt_edit_cliente_nombre'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            <input type="hidden" name="txt_edit_cliente_id" id="txt_edit_cliente_id">

                        </div>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA CEDULA=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class="fas fa-address-card"></i></span>
                            <input type="number" class='form-control input-lg' min='0' placeholder='Ingresar cédula'
                                id='txt_edit_cliente_document' name='txt_edit_cliente_document'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA MAIL=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-envelope'></i></span>
                            <input type="email" class='form-control input-lg' placeholder='Ingresar E-mail'
                                id='txt_edit_cliente_mail' name='txt_edit_cliente_mail'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA TELEFONO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-phone-square-alt'></i></span>
                            <input type="text" class='form-control input-lg' placeholder='Ingresar Teléfono' value='593'
                                id='txt_edit_cliente_telefono' name='txt_edit_cliente_telefono'
                                data-inputmask="'mask':'(+999) 99-999-9999'" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" data-mask required>

                        </div>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA DIRECCION=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-map-marker-alt'></i></span>
                            <input type="text" class='form-control input-lg' placeholder='Ingresar Dirección'
                                id='txt_edit_cliente_direccion' name='txt_edit_cliente_direccion'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA FECHA NACIMIENTO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-calendar-alt'></i></span>
                            <input type="text" class='form-control input-lg' placeholder='Ingresar fecha de nacimiento'
                                id='txt_edit_cliente_fechaNacimiento' name='txt_edit_cliente_fechaNacimiento'
                                data-inputmask="'alias':'yyyy-mm-dd'" data-mask aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" required>
                            <input type="hidden" name="txt_fecha_registro" id="txt_fecha_registro">

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>
                    <button type='submit' class='btn btn-warning'><i class="fas fa-check"></i> Guardar
                        cambios</button>

                </div>

            </form>

            <?php

              /*=============================================
              =OBJETO PARA EDITAR CLIENTE=
              =============================================*/
  
              $editarCliente = new ControllerClientes();
              $editarCliente -> ctl_EditarCLiente();

            ?>

        </div>

    </div>

</div>

<?php

  /*=============================================
  =OBJETO PARA ELIMINAR CLIENTE=
  =============================================*/

  $DeleteCliente = new ControllerClientes();
  $DeleteCliente -> ctl_DeleteCliente();
  
?>