<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Crear Venta 

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Crear Venta</li>

    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <div class='row'>

      <!--=============================================
      =                   FORMULARIO                   =
      =============================================-->      

      <div class='col-lg-5 col-xs-12'>

        <div class='box box-success'>

          <div class='box-header with-border'>

            <form role='form' method='POST'>
              
              <div class='box-body'>

                <div class='box'>

                  <!--=============================================
                  =   INPUT PARA ENTRADA DEL VENDEDOR             =
                  =============================================-->   

                  <div class='form-group'>

                    <div class='input-group'>

                      <span class='input-group-addon'><i class='fa fa-user'></i></span>
                      <input type="text" class='form-control' name="txt_registrarVenta_usuario" id="txt_registrarVenta_usuario" value='Usuario admin' readonly>

                    </div>

                  </div>

                   <!--=============================================
                  =   INPUT PARA ENTRADA DEL N. DE VENTA             =
                  =============================================-->   

                  <div class='form-group'>

                    <div class='input-group'>

                      <span class='input-group-addon'><i class='fa fa-user'></i></span>
                      <input type="text" class='form-control' name="txt_registrarVenta_nuevaVenta" id="txt_registrarVenta_nuevaVenta" value='23125334' readonly>

                    </div>

                  </div>

                   <!--=============================================
                  =   INPUT PARA ENTRADA DEL CLIENTE             =
                  =============================================-->   

                  <div class='form-group'>

                    <div class='input-group'>

                      <span class='input-group-addon'><i class='fa fa-user'></i></span>
                      <select class='form-control' name="cmbx_selectCliente" id="cmbx_selectCliente">
                      
                        <option value="">--Seleccionar CLiente--</option>

                      </select>

                      <span class='input-group-addon'>

                        <button type='button' class='btn btn-default btn-xs' data-toggle='modal' data-target='#modalAgregaCliente' data-dismiss='modal'>
                          
                          Agregar cliente

                        </button>
                      
                      </span>

                    </div>

                  </div>

                  <!--=============================================
                  =   INPUT PARA ENTRADA DEL PRODUCTO             =
                  =============================================-->   

                  <div class='form-group row div_nuevoProducto'>

                  <!-- ENTRADA PARA EL NOMBRE DEL PRODUCTO -->

                    <div class='col-xs-6' style='padding-right:0px'>

                      <div class='input-group'>

                        <span class='input-group-addon'>

                          <button type='button' class='btn btn-danger btn-xs'>

                            <i class='fa fa-times'></i>

                          </button>

                        </span>

                        <input type="text" class='form-control' name="txt_registrarVenta_nombreProducto" id="txt_registrarVenta_nombreProducto" placeholder='Descripción del producto' required>

                      </div>

                    </div>  

                    <!-- ENTRADA PARA LA CANTIDAD DEL PRODUCTO -->

                    <div class='col-xs-3'>

                      <input type="text" class='form-control' name="txt_registrarVenta_cantidadProducto" id="txt_registrarVenta_cantidadProducto" placeholder='0' min='1' required>
                  
                    </div>

                    <!-- ENTRADA PARA EL PRECIO DEL PRODUCTO -->

                    <div class='col-xs-3' style='padding-left:0px'>

                      <div class='input-group'>

                        <span class='input-group-addon'><i class='ion ion-social-usd'></i></span>

                        <input type="text" class='form-control' name="txt_registrarVenta_precioProducto" id="txt_registrarVenta_precioProducto" placeholder='000000' min='1' readonly required>

                      </div>

                    </div>

                  </div>

                  <!--=============================================
                  =  BUTTON RESPONSIVE AGREGAR PRODUCTO            =
                  =============================================--> 
                  
                  <button type='button' class='btn btn-default hidden-lg'>Agregar producto</button>

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

                                <input type="number" class='form-control' min='0' name="txt_registrarVenta_NuevoImpuestoVenta" id="txt_registrarVenta_NuevoImpuestoVenta" placeholder='0' required>
                                
                                <span class='input-group-addon'><i class='fa fa-percent'></i></span>

                              </div>

                            </td>

                            <td style='width: 50%'>
                          
                              <div class='input-group'>

                                <span class='input-group-addon'><i class='ion ion-social-usd'></i></span>

                                <input type="number" class='form-control' min='1' name="txt_registrarVenta_NuevoTotalVenta" id="txt_registrarVenta_NuevoTotalVenta" placeholder='00000' readonly required>

                              </div>

                            </td>
                          
                          </tr>

                        </tbody>

                      </table>

                    </div>

                  </div>

                  <hr>

                   <!--=============================================
                  =                 ENTRADA METODO DE PAGO           =
                  =============================================--> 

                  <div class='row'>

                    <div class='col-xs-5'>
                    
                      <div class='form-group'>

                        <div class='input-group'>
                          
                          <span class='input-group-addon'><i class="far fa-credit-card"></i></span>
                          <select class='form-control' name="cmbx_metodo_pago" id="cmbx_metodo_pago" required>

                            <option value="">--Seleccione Método de pago--</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta-Credito">Tarjeta de Débito</option>
                            <option value="Tarjeta-Debito">Tarjeta de crédito</option> 

                          </select>

                        </div>

                      </div>

                    </div>  

                    <div class='col-xs-7'>
                    
                      <div class='form-group'>

                        <div class='input-group'>
                          
                          <input type="text" class='form-control' name="txt_registrarVenta_NuevoCodigoTransaccion" id="txt_registrarVenta_NuevoCodigoTransaccion" placeholder='Código Transacción' required>
                          <span class='input-group-addon'><i class="fa fa-key"></i></span>

                        </div>

                      </div>

                    </div>  
                  
                  </div>

              </div>

              <div class="box-footer">

                <button type="submit" class="btn btn-primary pull-right"><i class="far fa-save"></i> Guardar venta</button>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

      <!--=============================================
      =      FORMULARIO TABLA DE PRODUCTOS            =
      =============================================--> 

      <div class='col-lg-7 hidden-md hidden-sm hidden-xs'>

        <div class='box box-warning'>

          <div class='box-header with-border'>

              <div class='box-body'>

                <table style='border-bottom:none !important;' class='table table-bordered table-striped dt-responsive tablasVenta'>

                  <thead>

                    <tr>

                      <th style='width:10px'>#</th>
                      <th>Imagen</th>
                      <th>Código</th>
                      <th>Stock</th>
                      <th>Acciones</th>

                    </tr>

                  </thead>
                  
                  <tbody>

                    <tr>

                      <td>1.</td>
                      <td><img src="views/img/img_products/default/anonymous.png" class='img-thumbnail' width='40px'></td>
                      <td>0012</td>
                      <td>Lore Lorem Lorem Lorem</td>
                      <td>Lore Lorem </td>
                      <td>

                        <div class='btn-group'>

                          <button type='button' class='btn btn-primary'><i class="fas fa-plus-square"></i> Agregar</button>

                        </div>

                      </td>

                    </tr>

                  </tbody>

                </table>

              </div>

            </div>

        </div>

      </div>

    </div>

  </section>
  <!-- /.content -->

</div>
  <!-- /.content-wrapper -->



  
  <!--/*=============================================
  =                   MODAL AGREGAR CLIENTE         =
  =============================================-->
  
  <div id="modalAgregaCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <!--/*=============================================
    =                   CABECERA MODAL                   =
    =============================================-->

    <form role='form' method='POST' autocomplete="off">

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Cliente</h4>

        </div>
    
    <!--/*=============================================
    =                   CUERPO MODAL                   =
    =============================================-->

        <div class="modal-body">

          <div class='box-body'>

          <!-- Input para entrada la categoría -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class="fas fa-user-circle"></i></span>
                <input type="text" class='form-control input-lg' placeholder='Ingresar Nombre' name='txt_register_cliente_nombre' required>

              </div>

            </div>

            
         <!-- Input para entrada DOCUMENTO -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class="fas fa-address-card"></i></span>
                <input type="number" class='form-control input-lg' min='0' placeholder='Ingresar cédula' name='txt_register_cliente_document' required>

              </div>

            </div>

            
         <!-- Input para entrada E-mail -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class="fas fa-envelope"></i></span>
                <input type="email" class='form-control input-lg' placeholder='Ingresar E-mail' name='txt_register_cliente_mail' required>

              </div>

            </div>

          <!-- Input para entrada teléfono -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class="fas fa-phone-square-alt"></i></span>
                <input type="text" class='form-control input-lg' placeholder='Ingresar Teléfono' value='593' name='txt_register_cliente_telefono' data-inputmask = "'mask':'(+999) 99-999-9999'" data-mask required>

              </div>

            </div>

            <!-- Input para entrada direccion -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class="fas fa-map-marker-alt"></i></span>
                <input type="text" class='form-control input-lg' placeholder='Ingresar Dirección' name='txt_register_cliente_direccion' required>

              </div>

            </div>

            <!-- Input para entrada direccion -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class="fas fa-calendar-alt"></i></span>
                <input type="text" class='form-control input-lg' placeholder='Ingresar fecha de nacimiento' name='txt_register_cliente_fechaNacimiento' data-inputmask = "'alias':'yyyy-mm-dd'" data-mask  required>

              </div>

            </div>


          </div>
        
        </div>

    <!--/*=============================================
    =                   PIE MODAL                   =
    ============================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type='submit' class='btn btn-primary'><i class="fas fa-plus-square"></i> Agregar Cliente</button>

        </div>

      </form>
    
    </div>

  </div>

</div>

  
  <!--============  End of MODAL AGREGAR USUARIO  =============-->
