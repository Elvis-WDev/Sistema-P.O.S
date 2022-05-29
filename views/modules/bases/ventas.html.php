<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Administrar Categoría

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Categoría</li>

    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        
        <button class='btn btn-primary' data-toggle='modal' data-target='#modalAgregarCategory'>
          
        <i class="fas fa-plus-square"></i> Agregar categoría

        </button>


      </div>

      <div class="box-body">

        <table style='border-bottom:none !important;' class='table table-bordered table-striped dt-responsive tablas'>

          <thead>

            <tr>
            
              <th style='border-bottom:none !important;'>#</th>
              <th style='border-bottom:none !important;'>Categoría</th>
              <th style='border-bottom:none !important;'>Acción</th>

            </tr>

          </thead>

          <tbody>

            <tr>

              <td style= "text-align:center;">#</td>
              <td style= "text-align:center;">Equipos Electromecánicos</td>

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
  =                   MODAL AGREGAR CATEGORY                   =
  =============================================-->
  
  <div id="modalAgregarCategory" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <!--/*=============================================
    =                   CABECERA MODAL                   =
    =============================================-->

    <form role='form' method='POST' autocomplete="off">

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Categoría</h4>

        </div>
    
    <!--/*=============================================
    =                   CUERPO MODAL                   =
    =============================================-->

        <div class="modal-body">

          <div class='box-body'>

          <!-- Input para entrada la categoría -->

            <div class='form-group'>

              <div class='input-group'>

                <span class='input-group-addon'><i class='fa fa-th'></i></span>
                <input type="text" class='form-control input-lg' placeholder='Ingresar categoría' name='txt_register_category' required>

              </div>

            </div>

          </div>
        
        </div>

    <!--/*=============================================
    =                   PIE MODAL                   =
    ============================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type='submit' class='btn btn-primary'><i class="fas fa-plus-square"></i> Agregar Categoría</button>

        </div>

      </form>
    
    </div>

  </div>

</div>

  
  <!--============  End of MODAL AGREGAR USUARIO  =============-->
