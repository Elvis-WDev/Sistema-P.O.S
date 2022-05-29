<?php 
                
    if($_SESSION['url_img'] != "" ){

        $URL_IMG_USER = $_SESSION["url_img"];

    }else{
        
        $URL_IMG_USER = "views/img/img_users/default/anonymous.png";

    }

    $fechaUserRegister = substr($_SESSION['fechaRegistrado'],5,-12);
    
    $fechaFormat = "";

    switch($fechaUserRegister){

        case 1:

            $fechaFormat = "Enero";

            break;
            case 2:

                $fechaFormat = "Febrero";
                
                break;
                case 3:

                    $fechaFormat = "Marzo";
                    
                    break;
                    case 4:
                        
                        $fechaFormat = "Abril";

                        break;
                        case 5:

                            $fechaFormat = "Mayo";

                            break;
                            case 6:

                                $fechaFormat = "Junio";

                                break;
                                case 7:

                                    $fechaFormat = "Julio";

                                    break;
                                    case 8:

                                        $fechaFormat = "Agosto";

                                        break;
                                        case 9:

                                            $fechaFormat = "Septiembre";

                                            break;
                                            case 10:

                                                $fechaFormat = "Octubre";

                                                break;
                                                case 11:

                                                    $fechaFormat = "Noviembre";

                                                    break;
                                                    case 12:

                                                        $fechaFormat = "Diciembre";

                                                        break;

    }

?>

<header class='main-header'>

    <!--=============================================
=                   LOGOTIPO                   =
=============================================-->
    <!-- style='background-color:#00c0ef;' -->
    <a href="home" class='logo' style='height:54px;text-decoration:none;'>

        <!-- LOGO MINI -->

        <span class='logo-mini'>

            <img src="views/img/img_template/logo_empresa.png" class='img-responsive' style='padding:2px;' width='55px'>

        </span>

        <!-- LOGO HORIZONTAL -->

        <span class='logo-lg'>

            <img src="views/img/img_template/logo_extended.png" class='img-responsive' style='padding:5px 0px;'
                width='150px'>

        </span>

    </a>

    <!--============  End of LOGOTIPO  =============-->

    <!--=============================================
=                   NAVIGATION-BAR                   =
=============================================-->

    <nav class='navbar navbar-static-top navbar' role='navigation' style="padding:0px">

        <!-- BOTÓN DE NAVEGACIÓN -->

        <a href="#" style="text-decoration:none;" class='sidebar-toggle toggle_button_header' data-toggle='push-menu'
            role='button'>

            <span class='sr-only'> Toggle navigation </span>

        </a>

        <!-- PERFIL DE USUARIO -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">

            <!-- Avatar -->
            <div class="dropdown" style='margin-right:15px;text-decoration:none'>

                <a style='text-decoration:none !important;color:#f9fafb'
                    class="dropdown-toggle d-flex align-items-center hidden-arrow icon_nameuser_header"
                    href="javascript:void(0)" id="dropdownMenuButton1" data-bs-toggle="dropdown" role="button"
                    aria-expanded="false">

                    <img src="<?= $URL_IMG_USER ?>" class="rounded-circle" style='margin-right:5px' height="25px"
                        alt="img_user" loading="lazy" />

                    <span style='text-decoration:none !important'>
                        <?= $_SESSION['nombre_user'] ?></span>

                </a>

                <!-- DROPDOWN TOGGLE USER -->
                <div class='dropdown-menu row bg-light' style='margin-left:-120px;margin-top:13px;'
                    aria-labelledby="dropdownMenuButton1">

                    <div class='col-lg-12 text-center'>
                        <img src="<?= $URL_IMG_USER ?>" class="img-thumbnail" alt="User Image" width='80px'>
                    </div>

                    <div class='col-lg-12 text-center' style='margin-top:10px;'>

                        <p>
                            <strong
                                style='font-size:14px;color'><?= strtoupper($_SESSION['usuario_user']).' - '.$_SESSION['perfil'] ?></strong>
                            <small style='font-size:11px;'>Miembro desde
                                <?= $fechaFormat." del ".substr($_SESSION['fechaRegistrado'],0,-15); ?></small>
                        </p>

                    </div>

                    <div class='col-lg-12'>

                        <div class='pull-right'>
                            <a href="logout" class='btn btn-default btn-sm'>Salir</a>
                        </div>

                    </div>

                </div>

            </div>

            <!-- SKINS STYLES -->

            <div class="dropdown" style='margin-right:20px'>

                <a href="#" data-toggle="control-sidebar" style='text-decoration:none;color:#f9fafb'><i
                        class="fa fa-gears icon_gear_header"></i></a>

            </div>

        </div>

        <!-- Right elements -->

    </nav>

    <!--============  End of NAVIGATION-BAR  =============-->
</header>