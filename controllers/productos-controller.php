<?php


class ControllerProducts{

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
    =                   MOSTAR PRODUCTOS                   =
    =============================================*/
    
    static public function ctl_MostrarProductos($column, $value){

        $tabla = 'productos';

        $respuesta = ModelProductos::mdl_MostrarProductos($tabla, $column, $value);

        return $respuesta;

    }

    /*=============================================
    =MOSTAR PRODUCTOS  REPORTES=
    =============================================*/
    
    static public function ctl_MostrarProductosResportes($column, $value, $order){

        $tabla = 'productos';

        $respuesta = ModelProductos::mdl_MostrarProductosReportes($tabla, $column, $value, $order);

        return $respuesta;

    }


     /*=============================================
    =                   CREAR PRODUCTOS                   =
    =============================================*/
    
    static public function ctl_CrearProducto(){

        if(isset($_POST['txt_register_product-descripcion'])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['txt_register_product-descripcion']) && 
            preg_match('/^[0-9]+$/', $_POST['txt_register_product-stock']) && 
            preg_match('/^[0-9.]+$/', $_POST['txt_register_product-PrecioCompra']) &&
            preg_match('/^[0-9.]+$/', $_POST['txt_register_product-PrecioVenta'])){
                
                /*=============================================
                =       VALIDAMOS SI LLEGA LA IMAGEN          =
                =============================================*/

                $url_img = 'views/img/img_products/default/anonymous.png';

                $archivo_cargado = trim((isset($_FILES['file_register_product']['tmp_name'])) ? $_FILES['file_register_product']['tmp_name'] : "");

                if($archivo_cargado){

                    list($ancho, $alto) = getimagesize($_FILES['file_register_product']['tmp_name']);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // Creamos directorio donde guardaremo la imagen.

                    $directorio = "views/img/img_products/".$_POST['txt_register_product-codigo'];

                    mkdir($directorio, 0755);

                    // Guardamos la IMG según su extensión.

                    if($_FILES["file_register_product"]["type"] == "image/jpeg"){

                        $hash_Generator = ControllerUser::uuid_v4();

                        $url_img = 'views/img/img_products/'.$_POST['txt_register_product-codigo'].'/'.$hash_Generator.'.jpg';

                        $origen = imagecreatefromjpeg($_FILES['file_register_product']['tmp_name']);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $url_img);

                    }

                    if($_FILES["file_register_product"]["type"] == "image/png"){

                        $hash_Generator = ControllerUser::uuid_v4();

                        $url_img = 'views/img/img_products/'.$_POST['txt_register_product-codigo'].'/'.$hash_Generator.'.png';

                        $origen = imagecreatefrompng($_FILES['file_register_product']['tmp_name']);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $url_img);

                    }

                } 
                

                $data = array('category' => $_POST['cmbx_register_product-category'],
                'codigo_producto' => $_POST['txt_register_product-codigo'],
                'descripcion_producto' => $_POST['txt_register_product-descripcion'],
                'stock_producto' => $_POST['txt_register_product-stock'],
                'precioCompra_producto' => $_POST['txt_register_product-PrecioCompra'],
                'precioVenta_producto' => $_POST['txt_register_product-PrecioVenta'],
                'url_img' => $url_img);

                $respuesta = ModelProductos::mdl_RegistrarPoducto($data);

                if($respuesta == 'ok'){

                    echo '<script>

                            Swal.fire({
            
                                type:"success",
                                icon:"success",
                                title: "¡El producto se ha guardado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText:"Cerrar",
                                closeOnConfirm:false,
                                confirmButtonColor: "#3c8dbc"
            
                            }).then((result)=>{
            
                                    if(result.value){
            
                                        window.location = "productos";
            
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
            
                                        window.location = "productos";
            
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
                        title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Ok",
            
                    }).then((result) => {
            
                        if (result.value) {
            
                            window.location = "productos";
            
                        }

                    })

                </script>';

            }

        }

        
    }

    
    
    /*=============================================
    =                   EDITAR PRODUCTOS                   =
    =============================================*/



    static public function ctl_EditarProducto(){

        if(isset($_POST['txt_edit_product-descripcion'])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['txt_edit_product-descripcion']) && 
            preg_match('/^[0-9]+$/', $_POST['txt_edit_product-stock']) && 
            preg_match('/^[0-9.]+$/', $_POST['txt_edit_product-PrecioCompra']) &&
            preg_match('/^[0-9.]+$/', $_POST['txt_edit_product-PrecioVenta'])){
                
                /*=============================================
                =       VALIDAMOS SI LLEGA LA IMAGEN          =
                =============================================*/

                $url_img = $_POST['imagen_default'];

                $archivo_cargado = trim((isset($_FILES['file_edit_product']['tmp_name'])) ? $_FILES['file_edit_product']['tmp_name'] : "");

                if($archivo_cargado && !empty($archivo_cargado)){

                    list($ancho, $alto) = getimagesize($_FILES['file_edit_product']['tmp_name']);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // Creamos directorio donde guardaremo la imagen.

                    $directorio = "views/img/img_products/".$_POST['txt_edit_product-codigo'];

                    /*=============================================
                    =PREGUNTAMOS SI EXISTE UNA IMAGEN EN BD=
                    =============================================*/
                    
                    if(!empty($_POST['imagen_default']) && $_POST['imagen_default'] != 'views/img/img_products/default/anonymous.png'){

                        unlink($_POST['imagen_default']);

                    }else{

                        mkdir($directorio, 0755);
                
                    }

                    // Guardamos la IMG según su extensión.

                    if($_FILES["file_edit_product"]["type"] == "image/jpeg"){

                        $hash_Generator = ControllerUser::uuid_v4();

                        $url_img = 'views/img/img_products/'.$_POST['txt_edit_product-codigo'].'/'.$hash_Generator.'.jpg';

                        $origen = imagecreatefromjpeg($_FILES['file_edit_product']['tmp_name']);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $url_img);

                    }

                    if($_FILES["file_edit_product"]["type"] == "image/png"){

                        $hash_Generator = ControllerUser::uuid_v4();

                        $url_img = 'views/img/img_products/'.$_POST['txt_edit_product-codigo'].'/'.$hash_Generator.'.png';

                        $origen = imagecreatefrompng($_FILES['file_edit_product']['tmp_name']);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $url_img);

                    }

                } 
                

                $data = array('category' => $_POST['cmbx_edit_product-category'],
                'codigo_producto' => $_POST['txt_edit_product-codigo'],
                'descripcion_producto' => $_POST['txt_edit_product-descripcion'],
                'stock_producto' => $_POST['txt_edit_product-stock'],
                'precioCompra_producto' => $_POST['txt_edit_product-PrecioCompra'],
                'precioVenta_producto' => $_POST['txt_edit_product-PrecioVenta'],
                'url_img' => $url_img);

                $respuesta = ModelProductos::mdl_EditarPoducto($data);

                if($respuesta == 'ok'){

                    echo '<script>

                            Swal.fire({
            
                                type:"success",
                                icon:"success",
                                title: "¡El producto se ha modificado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText:"Cerrar",
                                closeOnConfirm:false,
                                confirmButtonColor: "#3c8dbc"
            
                            }).then((result)=>{
            
                                    if(result.value){
            
                                        window.location = "productos";
            
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
            
                                        window.location = "productos";
            
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
                        title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Ok",
            
                    }).then((result) => {
            
                        if (result.value) {
            
                            window.location = "productos";
            
                        }

                    })

                </script>';

            }

        }

        
    }
    
    /*=============================================
    =                   ELIMINAR PRODUCTO=
    =============================================*/
    
    static public function ctl_DeleteProducto(){

        if(isset($_GET['id_prod'])){
            
            $data = $_GET['id_prod'];

            if($_GET['img_url'] != '' && $_GET['img_url'] != 'views/img/img_products/default/anonymous.png'){

                unlink($_GET['img_url']);
                echo 'views/img/img_products/'.$_GET['img_url'];
                rmdir('views/img/img_products/'.$_GET['cod_prod']);

            }

            $respuesta = ModelProductos::mdl_DeletePoducto($data);

            if($respuesta == 'ok'){

                echo '<script>

                Swal.fire({

                    type:"success",
                    icon:"success",
                    title: "¡El producto ha sido borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false,
                    confirmButtonColor: "#3c8dbc"

                    }).then((result)=>{

                        // if(result.value){

                        //     window.location = "productos";

                        // }

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

                            window.location = "productos";

                        }

                    })

                </script>';

            };

        }

    }

    /*=============================================
    =SUMAR VENTAS=
    =============================================*/
    
    static public function ctl_SumarVentasMostrar(){

        $tabla = "productos";

        $respuesta = ModelProductos::mdl_MostrarSumarVentas($tabla);

        return $respuesta;

    }

    /*=============================================
    =MOSTRAR PRODUCTOS RECIENTES=
    =============================================*/
    
    static public function ctl_MostrarProductosRecientes(){

        $respuesta = ModelProductos::mdl_MostrarProductosRecientes();

        return $respuesta;

    }

}