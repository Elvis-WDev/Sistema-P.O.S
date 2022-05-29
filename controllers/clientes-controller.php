<?php


class ControllerClientes{

    /*=============================================
    =                   CREAR CLIENTE                   =
    =============================================*/
    
    static public function ctl_crearCLiente(){

        if(isset($_POST['txt_register_cliente_nombre'])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["txt_register_cliente_nombre"]) &&
            preg_match('/^[0-9]+$/', $_POST["txt_register_cliente_document"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["txt_register_cliente_mail"]) && 
            preg_match('/^[+()\-0-9 ]+$/', $_POST["txt_register_cliente_telefono"]) && 
            preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["txt_register_cliente_direccion"])){

                // CAPTURO FECHA PARA ACTUAL PARA AGREGAR CLIENTE

                date_default_timezone_set('America/Guayaquil');

                $fecha = date('Y-m-d');
                
                $hora = date('H:i:s'); //,strtotime( '-1 hour')

                $fechaActual = $fecha.' '.$hora;

                
                $data = array('nombre' => $_POST['txt_register_cliente_nombre'],
                        'cedula' => $_POST['txt_register_cliente_document'],
                        'email' => $_POST['txt_register_cliente_mail'],
                        'telefono' => $_POST['txt_register_cliente_telefono'],
                        'direccion' => $_POST['txt_register_cliente_direccion'],
                        'fechaActual' => $fechaActual,
                        'fecha_nacimiento' => $_POST['txt_register_cliente_fechaNacimiento']);

                $respuesta = ModelClientes::mdl_crearCliente($data);

                if($respuesta == 'ok'){

                    echo '<script>

                            Swal.fire({
            
                                type:"success",
                                icon:"success",
                                title: "¡El cliente se ha guardado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText:"Cerrar",
                                closeOnConfirm:false,
                                confirmButtonColor: "#3c8dbc"
            
                            }).then((result)=>{
            
                                    if(result.value){
            
                                        window.location = "clientes";
            
                                    }
            
                            })
        
                        </script>';

                }else{

                    echo '<script>

                            Swal.fire({
            
                                type:"error",
                                icon: "error",
                                title: "¡Ha ocurrido un error al intentar guardar el registro!",
                                showConfirmButton: true,
                                confirmButtonText:"Cerrar",
                                closeOnConfirm:false
            
                            }).then((result)=>{
            
                                    if(result.value){
            
                                        window.location = "clientes";
            
                                    }
            
                            })
    
                    </script>';


                }


            }else{

                echo '
                <script>
                
                    Swal.fire({

                        type: "warning",
                        icon: "warning",
                        title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Ok",
            
                    }).then((result) => {
            
                        if (result.value) {
            
                            window.location = "clientes";
            
                        }

                    })

                </script>';

            }

        }

    }

     /*=============================================
    =                   EDITAR CLIENTE                   =
    =============================================*/
    
    static public function ctl_EditarCLiente(){

        if(isset($_POST['txt_edit_cliente_id']) && !empty($_POST['txt_edit_cliente_id'])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["txt_edit_cliente_nombre"]) &&
            preg_match('/^[0-9]+$/', $_POST["txt_edit_cliente_document"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["txt_edit_cliente_mail"]) && 
            preg_match('/^[+()\-0-9 ]+$/', $_POST["txt_edit_cliente_telefono"]) && 
            preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["txt_edit_cliente_direccion"])){

                
                $data = array('id' => $_POST['txt_edit_cliente_id'],
                        'nombre' => $_POST['txt_edit_cliente_nombre'],
                        'cedula' => $_POST['txt_edit_cliente_document'],
                        'email' => $_POST['txt_edit_cliente_mail'],
                        'telefono' => $_POST['txt_edit_cliente_telefono'],
                        'direccion' => $_POST['txt_edit_cliente_direccion'],
                        'fecha_nacimiento' => $_POST['txt_edit_cliente_fechaNacimiento'],
                        'fecha_registro' => $_POST['txt_fecha_registro']);

                $respuesta = ModelClientes::mdl_EditCliente($data);

                if($respuesta == 'ok'){

                    echo '<script>

                            Swal.fire({
            
                                type:"success",
                                icon:"success",
                                title: "¡El cliente se ha modificado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText:"Cerrar",
                                closeOnConfirm:false,
                                confirmButtonColor: "#3c8dbc"
            
                            }).then((result)=>{
            
                                    if(result.value){
            
                                        window.location = "clientes";
            
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
            
                                        window.location = "clientes";
            
                                    }
            
                            })
    
                    </script>';


                }


            }else{

                echo '
                <script>
                
                    Swal.fire({

                        type: "warning",
                        icon: "warning",
                        title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Ok",
            
                    }).then((result) => {
            
                        if (result.value) {
            
                            window.location = "clientes";
            
                        }

                    })

                </script>';

            }

        }

    }

    
    /*=============================================
    =                   MOSTRAR CLIENTES          =
    =============================================*/

    static public function ctl_mostrarCliente($column, $value){

        $respuesta = ModelClientes::mdl_MostrarCliente($column, $value);

        return $respuesta; 

    }

     /*=============================================
    =                   DELETE CLIENTES            =
    =============================================*/

    static public function ctl_DeleteCliente(){

        if(isset($_GET['id_client'])){

            $value = $_GET['id_client'];

            $respuesta = ModelClientes::mdl_DeleteCliente($value);

            if($respuesta == 'ok'){

                echo '<script>

                Swal.fire({

                    type:"success",
                    icon:"success",
                    title: "¡El cliente ha sido borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false,
                    confirmButtonColor: "#3c8dbc"

                    }).then((result)=>{

                        if(result.value){

                            window.location = "clientes";

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

                            window.location = "clientes";

                        }

                    })

                </script>';

            };

        }
       

    }


}