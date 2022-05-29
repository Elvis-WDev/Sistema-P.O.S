<?php

class ControllerCategory{


    /*=============================================
    =                   CREAR CATEGORIAS                   =
    =============================================*/
    
    
    static public function ctl_CrearCategoria(){

        if(isset($_POST['txt_register_category'])){
        
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['txt_register_category'])){

                $data = $_POST['txt_register_category'];

                $respuesta = ModelCategory::mdl_IngresarCategory($data);

                if($respuesta == 'ok'){

                    echo '<script>

                    Swal.fire({

                        type:"success",
                        icon: "success",
                        title: "¡La categoría se ha guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "category";

                            }

                        })

                    </script>';

                }else{

                    echo '<script>

                    Swal.fire({

                        type:"error",
                        icon: "error",
                        title: "¡No se ha podido guardar la categoría :(!",
                        showConfirmButton: true,
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "category";

                            }

                        })

                    </script>';

                }

            }else{

                echo '<script>

                Swal.fire({

                    type:"error",
                    icon: "error",
                    title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "category";

                        }

                    })

                </script>';


            }
        }
    }

    /*=============================================
    =                   MOSTRAR CATEGORIAS =
    =============================================*/
    
    static public function ctl_MostrarCategory($column, $value){

        $respuesta = ModelCategory::mdl_MostrarCategory($column, $value);

        return $respuesta;

    }

    /*=============================================
    =                   EDITAR CATEGORIAS =
    =============================================*/

    static public function ctl_EditarCategoria(){

        if(isset($_POST['txt_edit_category'])){
        
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['txt_edit_category'])){

                $data = array('categoria' => $_POST['txt_edit_category'],
                                'id_category' => $_POST['txt_edit_id_catgory']);

                $respuesta = ModelCategory::mdl_EditarCategory($data);

                if($respuesta == 'ok'){

                    echo '<script>

                    Swal.fire({

                        type:"success",
                        icon: "success",
                        title: "¡La categoría se ha modificado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "category";

                            }

                        })

                    </script>';

                }else{

                    echo '<script>

                    Swal.fire({

                        type:"error",
                        icon: "error",
                        title: "¡No se ha podido modificar la categoría :( !",
                        showConfirmButton: true,
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "category";

                            }

                        })

                    </script>';

                }

            }else{

                echo '<script>

                Swal.fire({

                    type:"error",
                    icon: "error",
                    title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "category";

                        }

                    })

                </script>';


            }
        }

    }


    /*=============================================
    =                   ELIMINAR CATEGORIAS =
    =============================================*/

    static public function ctl_EliminarCategoria(){

        if(isset($_GET['id_Categoria'])){

            $data = $_GET['id_Categoria'];

            $respuesta = ModelCategory::mdl_EliminarCategory($data);

            if($respuesta == 'ok'){

                echo '<script>

                Swal.fire({

                    type:"success",
                    icon: "success",
                    title: "¡La categoría se ha borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "category";

                        }

                    })

                </script>';


            }else{

                echo '<script>

                Swal.fire({

                    type:"error",
                    icon: "error",
                    title: "¡No se ha podido borrar la categoría!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "category";

                        }

                    })

                </script>';


            }

        }

    }

}