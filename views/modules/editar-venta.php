<?php

/*=============================================
=VALIDO EL ACCSES NO AUTORIZADO POR URL=
=============================================*/

  if($_SESSION["perfil"] == "Especial"){

    echo '<script>

      window.location = "home";

    </script>';

    return;

  }

?>

<!--=============================================
=INICIO DE MI PAGINA PARA EDITAR VENTAS=
=============================================-->

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <strong class="title_pages">Editar Venta</strong>

        </h1>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="breadcrumb-item active">Editar Venta</li>

        </ol>

    </section>

    <section class="content">

        <div class='row'>

            <!--=============================================
            =                   FORMULARIO                   =
            =============================================-->

            <div class='col-lg-5 col-xs-12 card_crear_venta'>

                <div class='box box-success'>

                    <div class='box-header with-border'>

                        <form role='form' method='POST' class='formVenta'>

                            <div class='box-body'>

                                <div class='box'>

                                    <?php  

                                        /*=============================================
                                        =LLAMO A MI VENTA POR MEDIO DE MI ID GET=
                                        =============================================*/
                                        
                                        $column_1 = 'id_venta';
                                        $value_1 = $_GET['id_venta'];

                                        $ventas = ControllerVentas::ctl_MostrarVentas($column_1, $value_1);

                                        /*=============================================
                                        =LLAMO A MI USUARIO=
                                        =============================================*/

                                        $tabla = 'usuarios';

                                        $column_2 = 'id_usuario';
                            
                                        $value_2 = $ventas["id_vendedor"];
                            
                                        $vendedor = ModelUser::mdl_MostrarUser($tabla, $column_2, $value_2);

                                      /*=============================================
                                        =LLAMO A MI CLIENTE=
                                        =============================================*/

                                        $column_3 = 'id_cliente';

                                        $value_3 = $ventas["id_cliente"];
                                        
                                        $cliente = ModelClientes::mdl_MostrarCliente($column_3, $value_3);

                                        $PorcentajeImpuesto = ($ventas['impuesto_venta'] * 100) / ($ventas['neto_venta']);

                                    ?>

                                    <!--=============================================
                                    =   INPUT PARA ENTRADA DEL VENDEDOR             =
                                    =============================================-->

                                    <div class='form-group mb-3'>

                                        <div class='input-group'>

                                            <span class='input-group-text'><i class='fa fa-user'></i></span>
                                            <input type="text" class='form-control' name="txt_registrarVenta_usuario"
                                                id="txt_registrarVenta_usuario"
                                                value='<?= $vendedor['nombre_usuario'] ?>' readonly>
                                            <input type="hidden" name="txt_registrarVenta_IDuser"
                                                value='<?= $vendedor['id_usuario'] ?>' id="txt_registrarVenta_IDuser">

                                        </div>

                                    </div>

                                    <!--=============================================
                                    =   INPUT PARA ENTRADA DEL N. DE VENTA             =
                                    =============================================-->

                                    <div class='form-group mb-3'>

                                        <div class='input-group'>

                                            <span class='input-group-text'><i class="fas fa-code"></i></span>
                                            <input type="text" class="form-control"
                                                name="txt_registrarVenta_EditarVenta" id="txt_registrarVenta_nuevaVenta"
                                                value="<?= $ventas['codigo_venta'] ?>" readonly>

                                        </div>

                                    </div>

                                    <!--=============================================
                                    =   INPUT PARA ENTRADA DEL CLIENTE             =
                                    =============================================-->

                                    <div class='form-group mb-3'>

                                        <div class='input-group input-group-sm' style='padding-bottom:10px !important;'>

                                            <span class='input-group-text'><i class="fas fa-user-friends"></i></span>
                                            <select class='form-select' name="cmbx_selectCliente"
                                                id="cmbx_selectCliente" required>

                                                <option value="<?= $cliente['id_cliente'] ?>">
                                                    <?= $cliente['nombre_cliente'] ?></option>

                                                <?php 
                        
                                                  $column = null;
                                                  $item = null;

                                                  $clientes =  ControllerClientes::ctl_mostrarCliente($column, $value);

                                                  foreach ($clientes as $key => $value) {

                                                    if($cliente['id_cliente'] != $value["id_cliente"]){
                                                    
                                                      echo '<option value="'.$value["id_cliente"].'">'.$value["nombre_cliente"].'</option>';
                                                    
                                                    }

                                                  }
                                                
                                                ?>

                                            </select>

                                            <span class='input-group-text'>

                                                <button type='button' class='btn btn-default btn-sm'
                                                    data-bs-toggle='modal' data-bs-target='#modalAgregarCliente'
                                                    data-bs-dismiss='modal'>

                                                    Agregar cliente

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                    <!--=============================================
                                    =   INPUT PARA ENTRADA DEL PRODUCTO             =
                                    =============================================-->

                                    <div class='form-group row div_nuevoProducto'>

                                        <?php
                  
                                          $ListaProductos = json_decode($ventas['productos_venta'], true);

                                          foreach($ListaProductos as $key => $valueProductos){

                                            
                                            $columnProd = 'id_producto';
                                            $valueProd = $valueProductos['id'];

                                            $DataProductos = ControllerProducts::ctl_MostrarProductos($columnProd, $valueProd);

                                            $Stockold = $DataProductos['stock_producto'] + $valueProductos['cantidad'];

                                        ?>

                                        <div class='row mb-2' style='padding-right:0px'>

                                            <div class='col-lg-6 col-sm-5 col-md-6 col-xs-5 caja_select'
                                                style='padding-right:0px'>

                                                <div class='input-group input-group-sm'>

                                                    <span class='input-group-text'>

                                                        <button type='button'
                                                            class='btn btn-danger btn-sm btn_quitarProducto'
                                                            data-id-product='<?= $valueProductos["id"] ?>'>

                                                            <i class='fa fa-times'></i>

                                                        </button>

                                                    </span>

                                                    <input type='text'
                                                        class='form-control txt_registrarVenta_nombreProducto'
                                                        data-id-product='<?= $valueProductos["id"] ?>'
                                                        name='txt_registrarVenta_nombreProducto'
                                                        id='txt_registrarVenta_nombreProducto'
                                                        placeholder='Descripción del producto'
                                                        value='<?= $valueProductos["nombre"] ?>' readonly required>

                                                </div>

                                            </div>

                                            <div class='col-lg-3 col-sm-3 col-xs-3 col-md-2 cantidadIngreso'>

                                                <input type='number'
                                                    class='form-control txt_registrarVenta_cantidadProducto'
                                                    name='txt_registrarVenta_cantidadProducto'
                                                    id='txt_registrarVenta_cantidadProducto' placeholder='0' min='1'
                                                    max='<?= $valueProductos["stock"] ?>'
                                                    value='<?= $valueProductos["cantidad"] ?>'
                                                    newStock='<?= $valueProductos["stock"] ?>' stock='<?= $Stockold ?>'
                                                    required>

                                            </div>

                                            <div class='col-lg-3 col-sm-4 col-xs-4 col-md-4 precioIngreso'
                                                style="padding-left:0px">

                                                <div class='input-group input-group-md'>

                                                    <span class='input-group-text'><i
                                                            class='ion ion-social-usd'></i></span>

                                                    <input type='text'
                                                        class='form-control txt_registrarVenta_precioProducto'
                                                        name='txt_registrarVenta_precioProducto'
                                                        data-precioIni='<?= $DataProductos['precio_venta_producto'] ?>'
                                                        id='txt_registrarVenta_precioProducto' placeholder='0.00'
                                                        min='1' value='<?= $valueProductos['precioTotalProduct'] ?>'
                                                        readonly required>

                                                </div>

                                            </div>

                                        </div>

                                        <?php
                                          }
                                        ?>

                                    </div>

                                    <!--=============================================
                                    =   INPUT PARA LISTAR DE PRODUCTOS             =
                                    =============================================-->

                                    <input type="hidden" name="inp_listaProductos" id="inp_listaProductos">

                                    <!--=============================================
                                    =  BUTTON RESPONSIVE AGREGAR PRODUCTO            =
                                    =============================================-->

                                    <button type='button' style="color:#fff"
                                        class='btn btn-default btn-primary hidden-lg btn_agregarProducto mb-4 mt-1'><i
                                            style="font-size:14px" class="fas fa-plus-circle"></i> Agregar
                                        producto</button>

                                    <!--=============================================
                                    =ENTRADA PARA IMPUESTO Y TOTAL           =
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
                                                                    value='<?= number_format($PorcentajeImpuesto,0) ?>'
                                                                    min='0' name="txt_registrarVenta_NuevoImpuestoVenta"
                                                                    id="txt_registrarVenta_NuevoImpuestoVenta"
                                                                    placeholder='0' required>

                                                                <input type="hidden"
                                                                    class='txt_registrarVenta_PrecioImpuestoAguardar'
                                                                    value='<?= $ventas["impuesto_venta"] ?>'
                                                                    name="txt_registrarVenta_PrecioImpuestoAguardar"
                                                                    id="txt_registrarVenta_PrecioImpuestoAguardar">

                                                                <input type="hidden"
                                                                    name="txt_registrarVenta_PrecioImpuestoNetoAguardar"
                                                                    value='<?= $ventas["neto_venta"] ?>'
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
                                                                    value='<?= $ventas["total"] ?>' min='1'
                                                                    data-totalprecio='<?= $ventas["neto_venta"] ?>'
                                                                    name="txt_registrarVenta_NuevoTotalVenta"
                                                                    id="txt_registrarVenta_NuevoTotalVenta"
                                                                    placeholder='0.00' readonly required>

                                                                <input type="hidden"
                                                                    name="txt_registrarVentaHD_NuevoTotalVenta"
                                                                    value='<?= $ventas["total"] ?>'
                                                                    id="txt_registrarVentaHD_NuevoTotalVenta">

                                                            </div>

                                                        </td>

                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                    <!--=============================================
                                    =                 ENTRADA METODO DE PAGO           =
                                    =============================================-->

                                    <div class='row'>

                                        <div class='col-xs-5 mb-3'>

                                            <div class='input-group'>

                                                <span class='input-group-text'><i class="far fa-credit-card"></i></span>
                                                <select class='form-select cmbx_metodo_pago' name="cmbx_metodo_pago"
                                                    id="cmbx_metodo_pago" required>
                                                    <option value="">--Seleccione Método de pago--</option>
                                                    <?php
                                                   if($ventas["metodo_pago"] == "Efectivo"){
                                                       echo '
                                                       <option value="Efectivo" selected>Efectivo</option>
                                                       <option value="TD">Tarjeta de Débito</option>
                                                       <option value="TC">Tarjeta de crédito</option>
                                                       ';
                                                   }else{
                                                        echo '
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="TC/TD" selected>Tarjeta de Débito/Crédito</option>
                                                        ';
                                                   }
                                                   
                                                   ?>

                                                </select>

                                            </div>

                                        </div>

                                        <div class='CajasMetodoPago col-lg-6 row'>

                                            <?php
                                            
                                            $codigo = $ventas["metodo_pago"];

                                            if($ventas["metodo_pago"] != "Efectivo"){
                                                
                                            ?>
                                            <div class="col-xs-7">

                                                <div class="form-group">

                                                    <div class="input-group">

                                                        <input type="text" class="form-control"
                                                            name="txt_registrarVenta_NuevoCodigoTransaccion"
                                                            id="txt_registrarVenta_NuevoCodigoTransaccion"
                                                            placeholder="Código Transacción" value="<?= $codigo ?>"
                                                            required>
                                                        <span class="input-group-text"><i class="fa fa-key"></i></span>


                                                    </div>

                                                </div>

                                            </div>

                                            <?php

                                            }

                                            ?>

                                        </div>

                                        <!--/*=============================================
                                        =INPUT PARA LA LISTA DE METODO PAGO=
                                        =============================================*/-->

                                        <input type="hidden" name="inpHD_listaMetodoPago" value="<?= $codigo ?>"
                                            id="inpHD_listaMetodoPago">

                                    </div>

                                </div>

                                <div class="box-footer">

                                    <button type="submit" class="btn btn-primary pull-right"><i class="far fa-save"></i>
                                        Guardar Cambios</button>

                                </div>

                        </form>

                        <?php

                          $EditarVenta = new ControllerVentas();
                          $EditarVenta -> ctl_EditarVenta();
                          
                        ?>

                    </div>

                </div>

            </div>

        </div>

        <!--=============================================
      =      FORMULARIO TABLA DE PRODUCTOS            =
      =============================================-->

        <div class='col-lg-7 hidden-md hidden-sm hidden-xs card_tabla_productosVentas'>

            <div class='box box-success'>

                <div class='box-header with-border'>

                    <div class='box-body'>

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
                    <button type='submit' class='btn btn-primary'><i class="fas fa-plus-square"></i> Guardar
                        cambios</button>

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