<?php

  if($_SESSION["perfil"] != "Administrador"){

    echo '<script>

      window.location = "home";

    </script>';

    return;

  }

?>
<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <strong class="title_pages">Reportes de Ventas</strong>
            <small>Estadísticas</small>

        </h1>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="breadcrumb-item active">Reportes de Ventas</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class='input-group'>

                    <button type="button" class="btn btn-default cancelBtn" id="daterange-btn2">

                        <span>
                            <i class="fa fa-calendar"></i> Rango de fecha
                        </span>

                        <i class="fa fa-caret-down"></i>

                    </button>

                </div>

                <div class="box-tools pull-right">

                    <?php
          
                          if(isset($_GET['fechaStart'])){

                            echo '<a href="views/modules/reportes/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaStart"].'&FechaFinal='.$_GET["fechaEnd"].'">';

                          }else{

                            echo '<a href="views/modules/reportes/descargar-reporte.php?reporte=reporte">';

                          }

                      ?>

                    <button class='btn btn-success btn_ReporteVentas' style='margin-top:5px;'> <i
                            class="far fa-file-excel"></i> Descargar
                        Reporte en Excel</button>

                    </a>

                </div>

            </div>

            <div class="box-body">

                <div class="row">

                    <div class="col-xs-12">

                        <?php

                        include "reportes/grafico-ventas.php";

                        ?>

                    </div>

                    <div class="row" style="padding-right:0px">

                        <div class="col-xs-6 col-lg-6" style="padding-right:0px">

                            <div>

                                <?php

                                  include "reportes/productosMasVendidos.php";

                                ?>

                            </div>

                        </div>

                        <div class="col-xs-6 col-lg-6 flex-column">

                            <div>

                                <?php

                                  include "reportes/vendedores.php";

                                ?>

                            </div>

                            <div>

                                <?php

                                  include "reportes/clientes.php";

                                ?>

                            </div>

                        </div>

                    </div>





                </div>

            </div>

            <div class="box-footer">


            </div>

        </div>


    </section>


</div>