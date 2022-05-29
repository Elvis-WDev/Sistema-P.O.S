<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Systema P.O.S</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="views/img/img_template/logo_empresa.png">
    <!--=============================================
    =                   PLUGINS CSS                   =
    =============================================*/-->


    <!-- Bootstrap 3.3.7 -->
    <!-- <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css"> -->

    <!-- Bootstrap v5.1.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/AdminLTE.css">

    <!-- style Mine -->
    <link rel="stylesheet" href="views/dist/css/mine-style.css">

    <!-- RESPONSIVE Mine -->
    <link rel="stylesheet" href="views/dist/css/responsive_mine.css">

    <!-- AdminLTE Skins. -->
    <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/dt-1.11.4/r-2.2.9/datatables.min.css" />

    <!-- Icheck -->
    <link rel="stylesheet" type="text/css" href="views/plugins/iCheck/all.css" />

    <!-- DateRangePicker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Morris Chart  -->
    <link rel="stylesheet" href="views/plugins/MorrisChart/morris.css">


    <!--============  End of PLUGINS CSS  =============-->



    <!--=============================================
    =                   PLUGINS JAVASCRIPT                   =
    =============================================*/-->



    <!-- jQuery 3 -->
    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap v5.1.3 -->
    <!-- <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- SlimScroll -->
    <script src="views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <!-- FastClick -->
    <script src="views/bower_components/fastclick/lib/fastclick.js"></script>

    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/994d5d8781.js" crossorigin="anonymous"></script>

    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.4/r-2.2.9/datatables.min.js"></script>

    <!-- SweetAlert2 -->
    <script type="text/javascript" src="views/plugins/sweetalert/sweetalert2.all.js"></script>

    <!-- Icheck -->
    <script type="text/javascript" src="views/plugins/iCheck/icheck.min.js"></script>

    <!-- InputMask -->
    <script src="views/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- JqueryNumber -->
    <script src="views/plugins/JqueryNumber/NumberJquery.min.js"></script>

    <!-- DateRangePicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Morris CHART -->
    <script src="views/plugins/MorrisChart/raphael-min.js"></script>
    <script src="views/plugins/MorrisChart/morris.min.js"></script>

    <!-- ChartJS -->
    <script src="views/bower_components/chart.js/chart.js"></script>

    <!--============  End of PLUGINS JAVASCRIPT  =============-->

</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <!-- Site wrapper -->

    <?php

    if(isset($_SESSION['confirm_login']) && $_SESSION['confirm_login'] == 'True'){

      echo '<div class="wrapper">';
      /*=============================================
      CABECERA                   =
      =============================================*/

      include 'views/modules/header.php';

      /*============  End of CABECERA  =============*/

      /*=============================================
      MENU NAVIGATION                   =
      =============================================*/

      include 'views/modules/menu.php';

      /*============  End of MENU NAVIGATION  =============*/

      /*=============================================
      CONTENIDO                  =
      =============================================*/
      if(isset($_GET['ruta'])){

        if($_GET['ruta'] == 'home' || $_GET['ruta'] == 'usuarios'||
        $_GET['ruta'] == 'category' || $_GET['ruta'] == 'productos' ||
        $_GET['ruta'] == 'clientes' || $_GET['ruta'] == 'ventas' ||
        $_GET['ruta'] == 'crear-venta' || $_GET['ruta'] == 'editar-venta' ||
        $_GET['ruta'] == 'reportes-ventas' || $_GET['ruta'] == 'logout'){
          
          include 'views/modules/'.$_GET['ruta'].'.php';

        }else{

          include 'views/modules/404.php';
        
        }
      
      }else
      {
      
        include 'views/modules/home.php';
      
      }
      /*============  End of Home-page  =============*/

      /*=============================================
                FOOTER=
      =============================================*/

      include 'views/modules/footer.php';

      /*============  End of FOOTER =============*/
      echo '</div>';
    }else{

      include 'views/modules/login.php';
    
    }
    ?>


    <!--/*=============================================
    =SIDEBAR SKINS=
    =============================================*/-->

    <aside class="control-sidebar control-sidebar-dark">

        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

        </ul>

        <div class="tab-content">

            <div class="tab-pane" id="control-sidebar-home-tab">


            </div>

            <div class="tab-content">

                <div id="control-sidebar-theme-demo-options-tab" class="tab-pane active">

                    <div>

                        <ul class="list-unstyled clearfix">
                            <!--=============================================
                        =CAJAS COLORES=
                        =============================================-->
                        </ul>

                    </div>

                </div>

                <!-- /.tab-pane -->
            </div>

        </div>

    </aside>
    <div class="control-sidebar-bg"></div>

    <!--=============================================
  =SCRIPTS COMPLEMENTARIOS DEL SISTEMA=
  =============================================*/-->

    <script src='views/js/template.js'></script>
    <script src='views/js/usuarios.js'></script>
    <script src='views/js/category.js'></script>
    <script src='views/js/productos.js'></script>
    <script src='views/js/clientes.js'></script>
    <script src='views/js/ventas.js'></script>
    <script src='views/js/reportes.js'></script>

    <!--/*=============================================
  =SKINS SITE=
  =============================================-->

    <script src='views/dist/js/demo.js'></script>

</body>

</html>
