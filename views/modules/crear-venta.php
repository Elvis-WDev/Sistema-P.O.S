<?php

  /*=============================================
  =VALIDO EL ACCESO NO AUTORIZADO POR URLS=
  =============================================*/

  if($_SESSION["perfil"] == "Especial"){

    echo '<script>

      window.location = "home";

    </script>';

    return;

  }

?>

<!--=============================================
=INICIO DE MI PAGINA DE CREAR VENTAS=
=============================================-->

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <strong class="title_pages">Crear Venta </strong>

        </h1>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="breadcrumb-item active">Crear Venta</li>

        </ol>

    </section>

    <section class="content">

        <div class='row'>

            <!--=============================================
            =                   FORMULARIO                 =
            =============================================-->

            <div class='col-lg-5 col-sm-12 col-xs-12 card_crear_venta'>

                <div class='box box-success'>

                    <div class='box-header with-border'>

                        <form role='form' method='POST' class='formVenta'>

                            <div class='box-body'>

                                <div class='box'>

                                    <!--=============================================
                                    =   INPUT PARA ENTRADA DEL USUARIO             =
                                    =============================================-->

                                    <div class='input-group mb-3'>

                                        <span class='input-group-text'><i class='fa fa-user'></i></span>
                                        <input type="text" class='form-control input-lg'
                                            name="txt_registrarVenta_usuario" id="txt_registrarVenta_usuario"
                                            value='<?= $_SESSION['nombre_user'] ?>' aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default" readonly>
                                        <input type="hidden" name="txt_registrarVenta_IDuser"
                                            value='<?= $_SESSION['id_usuario'] ?>' id="txt_registrarVenta_IDuser">

                                    </div>

                                    <!--=============================================
                                    =   INPUT PARA ENTRADA DEL N. DE VENTA=
                                    =============================================-->

                                    <div class='input-group mb-3'>

                                        <span class='input-group-text' id="txt_registrarVenta_usuario"><i
                                                class="fas fa-code"></i></span>

                                        <?php  
                      
                                            $column = null;
                                            $value_1 = null;

                                            $ventas = ControllerVentas::ctl_MostrarVentas($column, $value_1);

                                            if(!$ventas){

                                              echo '<input type="text" class="form-control input-lg" name="txt_registrarVenta_nuevaVenta" id="txt_registrarVenta_nuevaVenta" value="10001" readonly>';

                                            }else{

                                              foreach($ventas as $key => $value){
                                                // RECORRE Y TRAE TODOS LOS DATOS DEL CODIGO
                                              }

                                              // UTLIMO CODIGO QUE NECESITAMOS PARA EL NUEVO CODE

                                              $code = $value['codigo_venta'] + 1;
                                              
                                              echo '<input type="text" class="form-control input-lg" name="txt_registrarVenta_nuevaVenta" id="txt_registrarVenta_nuevaVenta" value="'.$code.'" readonly>';

                                            }

                                        ?>

                                    </div>

                                    <!--=============================================
                                    =   INPUT PARA ENTRADA DEL CLIENTE             =
                                    =============================================-->

                                    <div class='input-group input-group-sm mb-3 clienteINP-crearventa'
                                        style='padding-bottom:10px !important;'>

                                        <span class='input-group-text'><i class="fas fa-user-friends"></i></span>
                                        <select class='form-select' name="cmbx_selectCliente" id="cmbx_selectCliente"
                                            required>

                                            <option value="">--Seleccionar CLiente--</option>

                                            <?php 
                        
                                                $column = null;
                                                $item = null;

                                                $clientes =  ControllerClientes::ctl_mostrarCliente($column, $value);

                                                foreach ($clientes as $key => $value) {
                                                  
                                                  echo '<option value="'.$value["id_cliente"].'">'.$value["nombre_cliente"].'</option>';

                                                }
                                              
                                            ?>

                                        </select>

                                        <span class='input-group-text'>

                                            <button type='button' class='btn btn-default btn-sm' data-bs-toggle='modal'
                                                data-bs-target='#modalAgregarCliente' data-bs-dismiss='modal'>

                                                Agregar cliente

                                            </button>

                                        </span>

                                    </div>

                                    <!--=============================================
                                    =   INPUT PARA ENTRADA DEL PRODUCTO             =
                                    =============================================-->

                                    <div class='form-group row div_nuevoProducto'></div>

                                    <!--=============================================
                                    =   INPUT PARA LISTAR DE PRODUCTOS             =
                                    =============================================-->

                                    <input type="hidden" name="inp_listaProductos" id="inp_listaProductos">

                                    <!--=============================================
                                    =  BUTTON RESPONSIVE AGREGAR PRODUCTO            =
                                    =============================================-->

                                    <button type='button' style="color:#fff"
                                        class='btn btn-default btn-primary btn_agregarProducto mb-4 mt-1'>
                                        <i style="font-size:14px" class="fas fa-plus-circle"></i> Agregar producto
                                    </button>

                                    <!--=============================================
                                    =ENTRADA PARA IMPUESTO Y TOTAL=
                                    =============================================-->

                                    <div class='row'>

                                        <div class='col-xs-8 pull-right'>

                                            <table class='table'>

                                                <thead>

                                                    <tr>

                                                        <th>Impuesto</th>
                                                        <th>Total</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    <tr>

                                                        <td style='width: 50%'>

                                                            <div class='input-group'>

                                                                <input type="number"
                                                                    class='form-control txt_registrarVenta_NuevoImpuestoVenta'
                                                                    value='12' min='0'
                                                                    name="txt_registrarVenta_NuevoImpuestoVenta"
                                                                    id="txt_registrarVenta_NuevoImpuestoVenta"
                                                                    placeholder='0' required>

                                                                <input type="hidden"
                                                                    class='txt_registrarVenta_PrecioImpuestoAguardar'
                                                                    name="txt_registrarVenta_PrecioImpuestoAguardar"
                                                                    id="txt_registrarVenta_PrecioImpuestoAguardar">

                                                                <input type="hidden"
                                                                    name="txt_registrarVenta_PrecioImpuestoNetoAguardar"
                                                                    id="txt_registrarVenta_PrecioImpuestoNetoAguardar">

                                                                <span class='input-group-text'><i
                                                                        class='fa fa-percent'></i></span>

                                                            </div>

                                                        </td>

                                                        <td style='width: 50%'>

                                                            <div class='input-group'>

                                                                <span class='input-group-text'><i
                                                                        class='ion ion-social-usd'></i></span>

                                                                <input type="text"
                                                                    class='form-control txt_registrarVenta_NuevoTotalVenta'
                                                                    min='1' data-totalprecio=''
                                                                    name="txt_registrarVenta_NuevoTotalVenta"
                                                                    id="txt_registrarVenta_NuevoTotalVenta"
                                                                    placeholder='0.00' readonly required>

                                                                <input type="hidden"
                                                                    name="txt_registrarVentaHD_NuevoTotalVenta"
                                                                    id="txt_registrarVentaHD_NuevoTotalVenta">

                                                            </div>

                                                        </td>

                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                    <!--=============================================
                                    =ENTRADA METODO DE PAGO=
                                    =============================================-->

                                    <div class='row'>

                                        <div class='col-xs-5'>

                                            <div class='input-group'>

                                                <span class='input-group-text'><i class="far fa-credit-card"></i></span>
                                                <select class='form-select cmbx_metodo_pago' name="cmbx_metodo_pago"
                                                    id="cmbx_metodo_pago" required>

                                                    <option value="">--Seleccione Método de pago--</option>
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="TD">Tarjeta de Débito</option>
                                                    <option value="TC">Tarjeta de crédito</option>

                                                </select>

                                            </div>

                                        </div>

                                        <!--/*=========================================================
                                        =DIV SE LLENA DESDE JAVASCRIPT SEGUN LA OPCION DE METODO PAGO=
                                        ===============================================================*/-->

                                        <div class='CajasMetodoPago col-lg-6 row' style="padding-right:0px;">
                                        </div>

                                        <!--/*=============================================
                                        =INPUT PARA LA LISTA DE METODO PAGO=
                                        =============================================*/-->

                                        <input type="hidden" name="inpHD_listaMetodoPago" id="inpHD_listaMetodoPago">

                                    </div>

                                </div>

                                <div class="box-footer">

                                    <button type="submit" class="btn btn-primary pull-right"><i class="far fa-save"></i>
                                        Guardar venta</button>

                                </div>

                        </form>

                        <?php

                          /*=========================================================
                          =OBJETO QUE ENLAZA EL CONTROLADOR PARA GUARDAR LA VENTA=
                          =========================================================*/

                          $GuardarVenta = new ControllerVentas();
                          $GuardarVenta -> ctl_CrearVenta();
                          
                        ?>

                    </div>

                </div>

            </div>

        </div>

        <!--=============================================
      =      FORMULARIO TABLA DE PRODUCTOS            =
      =============================================-->

        <div class='col-lg-7 card_tabla_productosVentas'>

            <div class='box box-success'>

                <div class='box-header with-border'>

                    <div class='box-body'>

                        <!--==================================================
                        =INICIO DE MI TABLA DINAMICA DE PRODUCTOS PARA VENTAS=
                        ===================================================-->

                        <table style='border-bottom:none !important;'
                            class='table table-bordered table-striped dt-responsive TableVentas'>

                            <thead>

                                <tr>

                                    <th style='width:10px;text-align:center;'>#</th>
                                    <th style='text-align:center;'>Imagen</th>
                                    <th style='text-align:center;'>Código</th>
                                    <th style='text-align:center;'>Descripción</th>
                                    <th style='text-align:center;'>Stock</th>
                                    <th style='text-align:center;'>Precio de Venta</th>
                                    <th style='text-align:center;'>Acciones</th>

                                </tr>

                            </thead>

                            <!--=============================================
                            =DATOS LLENADOS DESDE AJAX=
                             =============================================-->

                        </table>

                    </div>

                </div>

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