<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Administrar Usuarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Usuarios</li>

    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        
        <button class='btn btn-primary' data-toggle='modal' data-target='#modalAgregarUsuario'>
          
        <i class="fas fa-plus-square"></i> Agregar Usuario

        </button>


      </div>

      <div class="box-body">

        <table style='border-bottom:none !important;' class='table table-bordered table-striped dt-responsive tablas'>

          <thead>

            <tr>
            
              <th style='border-bottom:none !important;'>#</th>
              <th style='border-bottom:none !important;'>Nombre</th>
              <th style='border-bottom:none !important;'>Usuario</th>
              <th style='border-bottom:none !important;'>Foto</th>
              <th style='border-bottom:none !important;'>Perfil</th>
              <th style='border-bottom:none !important;'>Estado</th>
              <th style='border-bottom:none !important;'>Último login</th>
              <th style='border-bottom:none !important;'>Acción</th>

            </tr>

          </thead>

          <tbody>

            <tr>

              <td>#</td>
              <td>Usuario Administrador</td>
              <td>Admin</td>
              <td style='display:flex;justify-content:center; text-align:center;'><img src="views/img/img_users/default/anonymous.png" class='img-thumbnail' width='40px' alt="default-img.png"></td>
              <td>Administrador</td>
              <td style='text-align: center;'><button class='btn btn-success btn-xs'>Activado</button></td>
              <td>2022-02-18 10:00:00</td>
              <td>

                <div style='display:flex;justify-content:center; text-align:center;' class='btn-group'>

                  <button class='btn btn-warning'><i class='fa fa-pencil'></i></button>
                  <button class='btn btn-danger'><i class='fa fa-times'></i></button>

                </div>

              </td>

            </tr>
             <tr>

              <td>#</td>
              <td>Usuario Administrador</td>
              <td>Admin</td>
              <td style='display:flex;justify-content:center; text-align:center;'><img src="views/img/img_users/default/anonymous.png" class='img-thumbnail' width='40px' alt="default-img.png"></td>
              <td>Administrador</td>
              <td style='text-align: center;'><button class='btn btn-success btn-xs'>Activado</button></td>
              <td>2022-02-18 10:00:00</td>
              <td>

                <div style='display:flex;justify-content:center; text-align:center;' class='btn-group'>

                  <button class='btn btn-warning'><i class='fa fa-pencil'></i></button>
                  <button class='btn btn-danger'><i class='fa fa-times'></i></button>

                </div>

              </td>

            </tr>
             <tr>

              <td>#</td>
              <td>Usuario Administrador</td>
              <td>Admin</td>
              <td style='display:flex;justify-content:center; text-align:center;'><img src="views/img/img_users/default/anonymous.png" class='img-thumbnail' width='40px' alt="default-img.png"></td>
              <td>Administrador</td>
              <td style='text-align: center;'><button class='btn btn-success btn-xs'>Activado</button></td>
              <td>2022-02-18 10:00:00</td>
              <td>

                <div style='display:flex;justify-content:center; text-align:center;' class='btn-group'>

                  <button class='btn btn-warning'><i class='fa fa-pencil'></i></button>
                  <button class='btn btn-danger'><i class='fa fa-times'></i></button>

                </div>

              </td>

            </tr>

          </tbody>

        </table>

      </div>
      <!-- /.box-body -->
      
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

</div>
  <!-- /.content-wrapper -->


  <!--/*=============================================
  =                   MODAL AGREGAR USUARIO                   =
  =============================================-->
  
  <div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <!--/*=============================================
    =                   CABECERA MODAL                   =
    =============================================-->

    <form role='form' method='POST' enctype='multipart/form-data' autocomplete="off">

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Usuario</h4>

        </div>
    
    <!--/*=============================================
    =                   CUERPO MODAL                   =
    =============================================-->

        <div class="modal-body">

          <div class='box-body'>

          <!-- Input para entrada del Nombre del usuario -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class='fa fa-user'></i></span>
                <input type="text" class='form-control input-lg' name='txt_register_user-nombre' required>

              </div>

            </div>

              <!-- Input para entrada del usuario -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class='fa fa-key'></i></span>
                <input type="text" class='form-control input-lg' name='txt_register_user-Usuario' required>

              </div>

            </div>

            <!-- Input para entrada de password  -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class='fa fa-lock'></i></span>
                <input type="password" class='form-control input-lg' name='txt_register_user-password' required>

              </div>

            </div>

              <!-- Input para entrada de perfil  -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class='fa fa-lock'></i></span>
                <select class='form-control input-lg' name="txt_register_user-perfil">

                  <option value="">-Seleccionar Perfil-</option>
                  <option value="">Administrador</option>
                  <option value="">Especial</option>
                  <option value="">Vendedor</option>

                </select>

              </div>

            </div>

            <div class='form-group'>

              <div class='panel'>SUBIR FOTO</div>
              
              <input class='inp-select-file' type="file" id='INP-files-user-foto' name="file_register_user-img">

              <p class='help-block'>Peso máximo de la foto 200 MB</p>

              <div style='display:flex;justify-content:center; text-align:center;'>

                <img src="views/img/img_users/default/anonymous.png" class='img-thumbnail' width='100px' alt="">

              </div>

            </div>



          </div>
        
        </div>

    <!--/*=============================================
    =                   PIE MODAL                   =
    ============================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type='submit' class='btn btn-primary'><i class="fas fa-plus-square"></i> Agregar Usuario</button>

        </div>

      </form>
    
    </div>

  </div>

</div>

  
  <!--============  End of MODAL AGREGAR USUARIO  =============-->
