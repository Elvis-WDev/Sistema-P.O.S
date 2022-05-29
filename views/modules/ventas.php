<?php

  if($_SESSION["perfil"] == "Especial"){

    echo '<script>

      window.location = "home";

    </script>';

    return;

  }

?>

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <strong class="title_pages">Administrar Venta</strong>

        </h1>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Venta</li>

        </ol>

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">

                <a href="crear-venta">
                    <button class='btn btn-primary'>

                        <i class="fas fa-plus-square"></i> Agregar Venta

                    </button>
                </a>

                <button type='button' class='btn btn-default pull-right' id='daterange-btn'>

                    <span>
                        <i class="fa fa-calendar"></i> Rango de fecha
                    </span>

                    <i class="fa fa-caret-down"></i>

                </button>

            </div>

            <div class="box-body table_section">

                <!--=============================================
      =DATATABLE GENERADA DESDE JS=
      =============================================*/-->

                <?php
    
              $EliminarVenta = new ControllerVentas();
              $EliminarVenta -> ctl_DeleteVenta();
              

              if(isset($_GET['fecha_ini'])){

                echo '<input type="hidden" class="inp_rangoTableFecha" data-fechaIni="'.$_GET['fecha_ini'].'" data-fechaFin="'.$_GET['fecha_final'].'" name="" id="">';

              }else{

                echo '<input type="hidden" class="inp_rangoTableFecha" data-fechaIni="" data-fechaFin="" name="" id="">';

              }

        ?>

            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->