<?php

class ControllerUser{


    /*=============================================
= Función par generar un hash para 
renombrar la IMG que llege.   =
=============================================*/

static public function uuid_v4()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

/*============  End of Función par generar un hash   =============*/



    /*=============================================
    =                   login USUARIOS                   =
    =============================================*/
    
    static public function ctr_IngresarUsuario(){

        if (isset($_POST['txt_user_login'])) {
            
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['txt_user_login']) && 
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['txt_password_login'])){
                    
                    $passwoord_encrypted = crypt($_POST['txt_password_login'], '$2a$07$usesomesillystringforsalt$');
                
                    $tabla = 'usuarios';

                    $column= 'usuario';
                    
                    $valor = $_POST['txt_user_login'];
                    
                    $respuesta = ModelUser::mdl_MostrarUser($tabla, $column, $valor );

                    if(isset($respuesta['usuario']) && isset($respuesta['password_usuario'])  
                    && $respuesta['usuario'] == $_POST['txt_user_login'] &&
                     $respuesta['password_usuario'] == $passwoord_encrypted){

                        if($respuesta['estado_usuario'] != 0){
                           
                            echo '<div class="alert alert-success"> Bienvenido al sistema. </div>';

                            $_SESSION['confirm_login'] = 'True';
    
                            $_SESSION['id_usuario'] = $respuesta['id_usuario'];
                            $_SESSION['nombre_user'] = $respuesta['nombre_usuario'];
                            $_SESSION['usuario_user'] = $respuesta['usuario'];
                            $_SESSION['url_img'] = $respuesta['foto_usuario'];
                            $_SESSION['perfil'] = $respuesta['perfil_usuario'];
                            $_SESSION['fechaRegistrado'] = $respuesta['fecha_usuario'];

                            /*=============================================
                            REGISTRAR EL ÚLTIMO LOGING
                            =============================================*/

                            date_default_timezone_set('America/Guayaquil');

                            $fecha = date('Y-m-d');
                            $hora = date('H:i:s',strtotime( '-1 hour'));

                            $fechaActual = $fecha.' '.$hora;

                            $item1 = 'ultimo_login_usuario';
                            $value1 = $fechaActual;

                            $item2 = 'id_usuario';
                            $value2 = $respuesta['id_usuario'];

                            $LastLogin = ModelUser::mdl_ModificarUsuario($item1, $value1, $item2, $value2);

                            if($LastLogin == 'ok'){

                                echo '<script>
    
                                    window.location = "home";

                                </script>';

                            }

                        }else{

                            echo '<div class="alert alert-danger">Usuario no activado.</div>';

                        }

                       
                    }else{

                        echo '<div class="alert alert-danger"> Usuario o contraseña incorrecto. Vuelve a intentarlo.</div>';

                    }

            }

        }

    }
    
    /*============  End of login USUARIOS  =============*/
    
    


    /*=============================================
    =                   REGISTRAR USUARIOS                   =
    =============================================*/

    static public function ctr_createUser(){

        if(isset($_POST['txt_register_user-nombre']) && isset($_POST['txt_register_user-Usuario']) 
        && isset($_POST['txt_register_user-password']) && isset($_POST['cmbx_register_user-perfil'])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['txt_register_user-nombre']) && 
            preg_match('/^[a-zA-Z0-9]+$/', $_POST['txt_register_user-Usuario']) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST['txt_register_user-password'])){
                
                $ruta="";

                $archivo_cargado = trim((isset($_FILES['file_register_user-img']['tmp_name'])) ? $_FILES['file_register_user-img']['tmp_name'] : "");

                if($archivo_cargado){

                    list($ancho, $alto) = getimagesize($_FILES['file_register_user-img']['tmp_name']);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // Creamos directorio donde guardaremo la imagen.

                    $directorio = "views/img/img_users/".$_POST['txt_register_user-Usuario'];

                    mkdir($directorio, 0755);

                    // Guardamos la IMG según su extensión.

                    if($_FILES["file_register_user-img"]["type"] == "image/jpeg"){

                        $hash_Generator = ControllerUser::uuid_v4();

                        $ruta = 'views/img/img_users/'.$_POST['txt_register_user-Usuario'].'/'.$hash_Generator.'.jpg';

                        $origen = imagecreatefromjpeg($_FILES['file_register_user-img']['tmp_name']);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if($_FILES["file_register_user-img"]["type"] == "image/png"){

                        $hash_Generator = ControllerUser::uuid_v4();

                        $ruta = 'views/img/img_users/'.$_POST['txt_register_user-Usuario'].'/'.$hash_Generator.'.png';

                        $origen = imagecreatefrompng($_FILES['file_register_user-img']['tmp_name']);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }

                } 
                
                $passwoord_encrypted = crypt($_POST['txt_register_user-password'], '$2a$07$usesomesillystringforsalt$');

                $data = array(
                    'nombre_usuario' => $_POST['txt_register_user-nombre'],
                    'usuario' => $_POST['txt_register_user-Usuario'],
                    'password_usuario' => $passwoord_encrypted,
                    'perfil_usuario' => $_POST['cmbx_register_user-perfil'],
                    'ruta' => $ruta);

                $respuesta = ModelUser::mdl_registrarUsuario($data);

                if($respuesta == 'ok'){

                    echo '<script>

                    Swal.fire({
    
                        type:"success",
                        icon:"success",
                        title: "¡El usuario ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false,
                        confirmButtonColor: "#3c8dbc"
    
                      }).then((result)=>{
    
                            if(result.value){
    
                                window.location = "usuarios";
    
                            }
    
                      })
    
                    </script>';

                }else{

                    echo '<script>

                    Swal.fire({
    
                        type:"error",
                        icon: "error",
                        title: "¡Ha ocurrido un error al intentar guardar el regisro!",
                        showConfirmButton: true,
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false
    
                      }).then((result)=>{
    
                            if(result.value){
    
                                window.location = "usuarios";
    
                            }
    
                      })
    
                    </script>';

                };

               

            }else{
                echo '<script>

                Swal.fire({

                    type:"error",
                    icon: "error",
                    title: "¡No se permite campos vacios o caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false

                  }).then((result)=>{

                        if(result.value){

                            window.location = "usuarios";

                        }

                  })

                </script>';
            }

        }
        
    }
    
    /*============  End of REGISTRAR USUARIOS  =============*/




     /*=============================================
    =                   MOSTRAR USUARIOS                   =
    =============================================*/


    static public function ctl_MostrarUsuarios($column, $value){

        $tabla = 'usuarios';

        $respuesta = ModelUser::mdl_MostrarUser($tabla, $column, $value);

        return $respuesta;
    }


    /*=============================================
    =                   MODIFICAR USUARIOS                   =
    =============================================*/

    static public function ctl_EditUser(){

            $txt_user_toEdit = trim((isset($_POST['txt_editar_user-Usuario'])) ? $_POST['txt_editar_user-Usuario'] : "");


        if($txt_user_toEdit){
            
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['txt_editar_user-nombre'])){

                    /*=============================================
                    =                   Valido la imagen                   =
                    =============================================*/

                $ruta = $_POST['txt_url_foto_actual'];

                $archivo_cargado = trim((isset($_FILES['file_editar_user-img']['tmp_name'])) ? $_FILES['file_editar_user-img']['tmp_name'] : "");

                if($archivo_cargado){

                    list($ancho, $alto) = getimagesize($_FILES['file_editar_user-img']['tmp_name']);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // Creamos directorio donde guardaremo la imagen.

                    $directorio = "views/img/img_users/".$txt_user_toEdit;

                    // PREGUNTAMOS SIS EXISTE UNA IMAGEN.

                        if(!empty($_POST['txt_url_foto_actual'])){

                        unlink($_POST['txt_url_foto_actual']);

                        }else{

                        mkdir($directorio, 0755);

                        }

                    // Guardamos la IMG según su extensión.

                    if($_FILES["file_editar_user-img"]["type"] == "image/jpeg"){

                        $hash_Generator = ControllerUser::uuid_v4();

                        $ruta = 'views/img/img_users/'.$txt_user_toEdit.'/'.$hash_Generator.'.jpg';

                        $origen = imagecreatefromjpeg($_FILES['file_editar_user-img']['tmp_name']);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if($_FILES["file_editar_user-img"]["type"] == "image/png"){

                        $hash_Generator = ControllerUser::uuid_v4();

                        $ruta = 'views/img/img_users/'.$txt_user_toEdit.'/'.$hash_Generator.'.png';

                        $origen = imagecreatefrompng($_FILES['file_editar_user-img']['tmp_name']);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }

                } 

                if($_POST['txt_editar_user-password'] != ""){

                    if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['txt_editar_user-password'])){

                        $passwoord_encrypted = crypt($_POST['txt_editar_user-password'], '$2a$07$usesomesillystringforsalt$');

                    }else{

                        echo '<script>

                        Swal.fire({
        
                            type:"error",
                            icon: "error",
                            title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText:"Cerrar",
                            closeOnConfirm:false
        
                            }).then((result)=>{
        
                                if(result.value){
        
                                    window.location = "usuarios";
        
                                }
        
                            })
        
                        </script>';

                    }

                }else{

                    $passwoord_encrypted = $_POST['txt_edit_user_passwordActual'];

                }

                $data = array(
                'nombre_usuario' => $_POST['txt_editar_user-nombre'],
                'usuario' => $_POST['txt_editar_user-Usuario'],
                'password_usuario' => $passwoord_encrypted,
                'perfil_usuario' => $_POST['cmbx_editar_user-perfil'],
                'ruta' => $ruta);

                $respuesta = ModelUser::mdl_EditarUsuario($data);

                if($respuesta == 'ok'){

                    echo '<script>

                    Swal.fire({

                        type:"success",
                        icon:"success",
                        title: "¡El usuario ha sido modificado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false,
                        confirmButtonColor: "#3c8dbc"

                        }).then((result)=>{

                            if(result.value){

                                window.location = "usuarios";

                            }

                        })

                    </script>';

                }else{

                    echo '<script>

                    Swal.fire({

                        type:"error",
                        icon: "error",
                        title: "¡Ha ocurrido un error al intentar modificar el registro!",
                        showConfirmButton: true,
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "usuarios";

                            }

                        })

                    </script>';

                };
                
            }

        }

    }

    /*=============================================
    =   ELIMINAR USUARIOS  =
    =============================================*/

    static public function clt_DeleteUser(){

        if(isset($_GET['id_user'])){

            $data = $_GET['id_user'];

            if($_GET['img_url'] != ''){

                unlink($_GET['img_url']);
                rmdir('views/img/img_users/'.$_GET['user']);

            }

            $respuesta = ModelUser::mdl_DeleteUsuario($data);

            if($respuesta == 'ok'){

                echo '<script>

                Swal.fire({

                    type:"success",
                    icon:"success",
                    title: "¡El usuario ha sido borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false,
                    confirmButtonColor: "#3c8dbc"

                    }).then((result)=>{

                        if(result.value){

                            window.location = "usuarios";

                        }

                    })

                </script>';

            }else{

                echo '<script>

                Swal.fire({

                    type:"error",
                    icon: "error",
                    title: "¡Ha ocurrido un error al intentar borrar el registro!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "usuarios";

                        }

                    })

                </script>';

            };

        }

    } 

}