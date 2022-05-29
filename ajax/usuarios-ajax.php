<?php

require_once("../controllers/usuarios-controller.php");
require_once("../models/usuarios-model.php");

    class usuariosAjax{
        
        
        /*=============================================
        =                   EDITAR USUARIOS                   =
        =============================================*/
        
        public $id_user;

        public function ajaxEditarUsuario(){

            $column = "id_usuario";
            $value = $this->id_user;

            $respuesta = ControllerUser::ctl_MostrarUsuarios($column,$value);

            echo json_encode($respuesta);

        }


         /*=============================================
        =                   ACTIVAR USUARIOS                   =
        =============================================*/

        public $activar_id;
        public $usuarioEstadoToChange;

        public function ajaxActivarUsuario(){

            $item1 = "estado_usuario";
            $value1 = $this -> usuarioEstadoToChange;

            $item2 = "id_usuario";
            $value2 = $this -> activar_id;

            $respuesta = ModelUser::mdl_ModificarUsuario($item1, $value1, $item2, $value2);

            echo json_encode($respuesta);

        }

        
         /*=============================================
        =                   VALIDAR NO REPITA USUARIOS                   =
        =============================================*/

        public $validar_user_value;

        public function ajaxValidarNORepeatUser(){

            $column = "usuario";
            $value = $this->validar_user_value;

            $respuesta = ControllerUser::ctl_MostrarUsuarios($column,$value);

            echo json_encode($respuesta);

        }

    }

    /*=============================================
        =                   EDITAR USUARIOS                   =
        =============================================*/

    $id_user_post = trim((isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : "");

    if($id_user_post){

        $editar = new usuariosAjax();
        $editar -> id_user = $_POST["id_usuario"];
        $editar -> ajaxEditarUsuario();

    }

    /*=============================================
        =                   ACTIVAR USUARIOS                   =
        =============================================*/

        $id_user_post_toActivate = trim((isset($_POST['activar_id'])) ? $_POST['activar_id'] : "");
        $estado_user_post_toActivate = trim((isset($_POST['usuarioEstadoToChange'])) ? $_POST['usuarioEstadoToChange'] : "");

        if(isset($_POST['activar_id'])){

            $activateUser = new usuariosAjax();
            $activateUser -> activar_id = $id_user_post_toActivate;
            $activateUser -> usuarioEstadoToChange = $estado_user_post_toActivate; 

            $activateUser -> ajaxActivarUsuario();

        }

        /*=============================================
        = VALIDAR NO REPITA USUARIOS                   =
        =============================================*/

        $user_value = trim((isset($_POST['validar_user_value'])) ? $_POST['validar_user_value'] : "");

        if(isset($_POST['validar_user_value'])){

            $valueUsr = new usuariosAjax();
            $valueUsr -> validar_user_value = $user_value;
            $valueUsr -> ajaxValidarNORepeatUser();

        }

    

?>