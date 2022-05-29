<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <strong class="title_pages">Dashboard</strong>

            <small>Panel de Control</small>

        </h1>

        <ul class="breadcrumb">

            <li class="breadcrumb-item active" aria-current="page"><a href="javascript:void(0)"><i
                        class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="breadcrumb-item" aria-current="page"> Dashboard</li>

        </ul>

    </section>

    <section class="content">

        <div class="row">

            <?php

                if($_SESSION["perfil"] == "Administrador"){

                  include "home/cajas-superiores.php";

                }

            ?>

        </div>

        <div class="row">

            <div class="col-lg-12">

                <?php

          if($_SESSION["perfil"] == "Administrador"){
          
           include "reportes/grafico-ventas.php";

          }

          ?>

            </div>

            <div class="col-lg-6">

                <?php

          if($_SESSION["perfil"] =="Administrador"){
          
           include "reportes/productosMasVendidos.php";

         }

          ?>

            </div>

            <div class="col-lg-6">

                <?php

          if($_SESSION["perfil"] =="Administrador"){
          
           include "home/productos-recientes.php";

          }

          ?>

            </div>

            <div class="col-lg-12">

                <?php

          if($_SESSION["perfil"] =="Especial" || $_SESSION["perfil"] == "Vendedor"){

             echo '<div class="box box-success">

             <div class="box-header">

             <h1>Bienvenid@ ' .$_SESSION["nombre_user"].'</h1>

             </div>

             </div>';

          }

          ?>

            </div>

        </div>

    </section>

</div>