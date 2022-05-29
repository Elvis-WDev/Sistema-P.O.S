<?php

    /*=============================================
    =VALIDO ACCESO NO AUTORIZADO POR URLS=
    =============================================*/
    
    if($_SESSION["perfil"] == "Vendedor"){

        echo '<script>

        window.location = "home";

        </script>';

        return;

    }

?>

<!--=============================================
=INICIO DE MI PAGINA PRODUCTOS=
=============================================-->

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <strong class="title_pages">Administrar Productos</strong>

        </h1>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Productos</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <!--=============================================
                =BOTONE PARA AGREGAR PRODUCTOS=
                =============================================-->
                <button class='btn btn-primary btn_AgregarProducto' data-bs-toggle='modal'
                    data-bs-target='#modalAgregarProducto'>

                    <i class="fas fa-plus-square"></i> Agregar Productos

                </button>

            </div>

            <div class="box-body">

                <!--=============================================
                =INICIO DE MI TABLA DINAMICA=
                =============================================-->

                <table style='border-bottom:none !important;'
                    class='table table-bordered table-striped dt-responsive tableProductos'>

                    <thead>

                        <tr>

                            <th style='border-bottom:none !important;'>#</th>
                            <th style='border-bottom:none !important;'>Imagen</th>
                            <th style='border-bottom:none !important;'>Código</th>
                            <th style='border-bottom:none !important;'>Descripción</th>
                            <th style='border-bottom:none !important;'>Categoría</th>
                            <th style='border-bottom:none !important;'>Stock</th>
                            <th style='border-bottom:none !important;'>Precio de compra</th>
                            <th style='border-bottom:none !important;'>Precio de venta</th>
                            <th style='border-bottom:none !important;'>Agregado</th>
                            <th style='border-bottom:none !important;'>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <!--/*=============================================
                        =TABLA DE PRODUCTOS QUE SE LLENA POR AJAX=
                        =============================================*/-->

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--/*=============================================
=MODAL AGREGAR PRODUCTO=
=============================================-->

<div class="modal fade" id="modalAgregarProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">

            <form role='form' method='POST' enctype='multipart/form-data'>

                <!--/*=============================================
                =CABECERA MODAL=
                =============================================-->

                <div class="modal-header" style="background-color:#367fa9">

                    <h4 class="modal-title" id="staticBackdropLabel" style="color:#f4f4f4"><i
                            class="fab fa-product-hunt"></i> Registro de producto
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!--/*=============================================
                =CUERPO MODAL=
                =============================================-->

                <div class="modal-body">

                    <div class='box-body'>

                        <!--/*=============================================
                        =ENTRADA PARA CATEGORIA PRODUCTO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text'><i class='fa fa-list'></i></span>
                            <select class='form-select input-lg' id='cmbx_categoria_selected'
                                name="cmbx_register_product-category" required>

                                <option value="">-Seleccionar categoría-</option>
                                <?php

                                    /*=============================================
                                    =TRAIGO MIS CATEGORIAS DESDE BD=
                                    =============================================*/

                                    $column = null;
                                    $value = null;

                                    $categorias = ControllerCategory::ctl_MostrarCategory($column, $value);

                                    foreach($categorias as $key => $valor){

                                        echo "<option value='".$valor['id_category']."'>".$valor['categoria']."</option>";

                                    }

                                ?>

                            </select>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA CODIGO PRODUCTO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fa fa-code'></i></span>
                            <input type="text" class='form-control input-lg' id='txt_code_register'
                                name='txt_register_product-codigo' placeholder='código'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly
                                required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA DESCRIPCION PRODUCTO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text'><i class='fa fa-product-hunt'></i></span>
                            <input type="text" class='form-control input-lg' name='txt_register_product-descripcion'
                                placeholder='Ingresar descripción' aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA STOCK PRODUCTOS=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fa fa-check'></i></span>
                            <input type="number" class='form-control input-lg' name='txt_register_product-stock' min='0'
                                placeholder='stock' aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =FILA PARA PRECIO VENTA Y PRECIO COMPRA=
                        =============================================*/-->

                        <div class='form-group row'>

                            <!--/*=============================================
                            =ENTRADA PARA PRECIO COMPRA=
                            =============================================*/-->

                            <div class='col-xs-12 col-sm-6'>

                                <div class='input-group input-group-lg mb-3'>

                                    <span class='input-group-text' id="inputGroup-sizing-default"><i
                                            class='fa fa-arrow-down'></i></span>
                                    <input type="number" class='form-control input-lg'
                                        id='txt_register_product-PrecioCompra' name='txt_register_product-PrecioCompra'
                                        min='0' step='any' placeholder='Precio de compra'
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                        required>

                                </div>

                            </div>

                            <!--/*=============================================
                            =ENTRADA PARA PRECIO VENTA=
                            =============================================*/-->

                            <div class='col-xs-12 col-sm-6'>

                                <div class='input-group input-group-lg mb-3'>

                                    <span class='input-group-text' id="inputGroup-sizing-default"><i
                                            class='fa fa-arrow-up'></i></span>
                                    <input type="number" class='form-control input-lg'
                                        id='txt_register_product-PrecioVenta' name='txt_register_product-PrecioVenta'
                                        min='0' step='any' placeholder='Precio de venta'
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                        required>

                                </div>

                            </div>

                        </div>

                        <div class='form-group row'>

                            <!--/*=============================================
                            =CHECKBOX PARA PORCENTAJE=
                            =============================================*/-->

                            <div class='col-xs-12 col-sm-6'>

                                <div class='input-group input-group-lg mb-3'>

                                    <label style="line-height:40px">

                                        <input type="checkbox" name="" class='minimal porcentaje' id="checkbox_percent"
                                            checked>
                                        Utilizar Porcentaje

                                    </label>

                                </div>

                            </div>

                            <!--/*=============================================
                            =ENTRADA PARA PORCENTAJE=
                            =============================================*/-->

                            <div class='col-xs-12 col-sm-6'>

                                <div class='input-group input-group-lg mb-3'>

                                    <input type="number" class="form-control input-lg int-porcentaje-nuevo" min='0'
                                        value='12' name="" id="">

                                    <span class='input-group-text'><i class='fa fa-percent'></i></span>


                                </div>

                            </div>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA IMAGEN=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-image'></i></span>
                            <input class='form-control file_inp_producto' type="file" name="file_register_product"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

                        </div>

                        <div class='col-lg-12 row'>

                            <p class='help-block'>Peso máximo de la imagen 2 MB</p>

                            <div style='text-align:center;'>

                                <img src="views/img/img_products/default/anonymous.png" class='img-thumbnail prev-img'
                                    width='100px' alt="">

                            </div>

                        </div>

                    </div>

                </div>

                <!--/*=============================================
                =PIE MODAL=
                =============================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>
                    <button type='submit' class='btn btn-primary'><i class="fas fa-plus-square"></i> Agregar
                        producto</button>

                </div>

            </form>

            <?php
            
              /*=============================================
              =OBEJTO PARA REGISTRAR PRODUCTO=
              =============================================*/
            
              $SaveProduct = new ControllerProducts();
              $SaveProduct -> ctl_CrearProducto();

            ?>

        </div>

    </div>

</div>

<!--/*=============================================
=MODAL EDITAR PRODUCTO=
=============================================-->

<div class="modal fade" id="modalEditarProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">

            <form role='form' method='POST' enctype='multipart/form-data'>

                <!--/*=============================================
                =CABECERA MODAL=
                =============================================-->

                <div class="modal-header" style="background-color:#e08e0b">

                    <h4 class="modal-title" id="staticBackdropLabel" style="color:#f4f4f4"><i
                            class="fab fa-product-hunt" tyle="margin-right:10px"></i> Editar producto
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!--/*=============================================
                =CUERPO MODAL=
                =============================================-->

                <div class="modal-body">

                    <div class='box-body'>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA CATEGORIA PRODUCTO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text'><i class='fa fa-list'></i></span>
                            <select class='form-control input-lg' name="cmbx_edit_product-category" readonly requiered>

                                <option id='cmbx_categoria_selected_edit'>------</option>

                            </select>

                        </div>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA CODIGO PRODUCTO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fa fa-code'></i></span>

                            <input type="text" class='form-control input-lg' id='txt_code_edit'
                                name='txt_edit_product-codigo' aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" readonly required>

                        </div>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA DESCRIPCION PRODUCTO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text'><i class='fa fa-product-hunt'></i></span>
                            <input type="text" class='form-control input-lg' id='txt_edit_product-descripcion'
                                name='txt_edit_product-descripcion' placeholder='Ingresar descripción'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA STOCK PRODUCTOS=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fa fa-check'></i></span>
                            <input type="number" class='form-control input-lg' id='txt_edit_product-stock'
                                name='txt_edit_product-stock' min='0' placeholder='stock'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =EDITAR FILA PARA PRECIO VENTA Y PRECIO COMPRA=
                        =============================================*/-->

                        <div class='form-group row'>

                            <!--/*=============================================
                            =EDITAR ENTRADA PARA PRECIO COMPRA=
                            =============================================*/-->

                            <div class='col-xs-12 col-sm-6'>

                                <div class='input-group input-group-lg mb-3'>

                                    <span class='input-group-text' id="inputGroup-sizing-default"><i
                                            class='fa fa-arrow-down'></i></span>

                                    <input type="number" class='form-control input-lg txt_edit_product-PrecioCompra'
                                        id='txt_edit_product-PrecioCompra' name='txt_edit_product-PrecioCompra' min='0'
                                        step='any' placeholder='Precio de compra' aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-default" required>

                                </div>

                            </div>

                            <!--/*=============================================
                            =EDITAR ENTRADA PARA PRECIO VENTA=
                            =============================================*/-->

                            <div class='col-xs-12 col-sm-6'>

                                <div class='input-group input-group-lg mb-3'>

                                    <span class='input-group-text' id="inputGroup-sizing-default"><i
                                            class='fa fa-arrow-up'></i></span>
                                    <input type="number" class='form-control input-lg' id='txt_edit_product-PrecioVenta'
                                        name='txt_edit_product-PrecioVenta' min='0' step='any'
                                        placeholder='Precio de venta' aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-default" readonly required>

                                </div>

                            </div>

                        </div>

                        <div class='form-group row'>

                            <!--/*=============================================
                            =EDITAR CHECKBOX PARA PORCENTAJE=
                            =============================================*/-->

                            <div class='col-xs-12 col-sm-6'>

                                <div class='input-group input-group-lg mb-3'>

                                    <label style="line-height:40px">

                                        <input type="checkbox" name="" class='minimal porcentaje' id="checkbox_percent"
                                            checked>
                                        Utilizar Porcentaje

                                    </label>

                                </div>

                            </div>

                            <!--/*=============================================
                            =EDITAR ENTRADA PARA PORCENTAJE=
                            =============================================*/-->

                            <div class='col-xs-12 col-sm-6'>

                                <div class='input-group input-group-lg mb-3'>

                                    <input type="number" class="form-control input-lg int-porcentaje-edit" min='0'
                                        value='12' name="" id="">

                                    <span class='input-group-text'><i class='fa fa-percent'></i></span>


                                </div>

                            </div>

                        </div>

                        <!--/*=============================================
                        =EDITAR ENTRADA PARA IMAGEN=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class='input-group-text' id="inputGroup-sizing-default"><i
                                    class='fas fa-image'></i></span>
                            <input class='form-control file_inp_producto' type="file" name="file_edit_product"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

                        </div>

                        <div class='col-lg-12 row'>

                            <p class='help-block'>Peso máximo de la imagen 2 MB</p>

                            <div style='text-align:center;'>

                                <img src="views/img/img_products/default/anonymous.png" class='img-thumbnail prev-img'
                                    width='100px' alt="">

                                <input type="hidden" name="imagen_default" id="imagen_default">

                            </div>

                        </div>

                    </div>

                </div>

                <!--/*=============================================
                =PIE MODAL=
                =============================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>
                    <button type='submit' class='btn btn-warning'><i class="fas fa-check"></i> Guardar
                        Cambios</button>

                </div>

            </form>

            <?php
            
              /*=============================================
              =OBEJTO PARA EDITAR PRODUCTO=
              =============================================*/

              $editarProduct = new ControllerProducts();
              $editarProduct -> ctl_EditarProducto();

            ?>

        </div>

    </div>

</div>

<?php

  /*=============================================
  =OBEJTO PARA ELIMINAR PRODUCTO=
  =============================================*/

  $deleteProduct = new ControllerProducts();
  $deleteProduct -> ctl_DeleteProducto();

?>