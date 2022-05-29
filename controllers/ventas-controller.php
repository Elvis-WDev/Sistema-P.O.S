<?php

class ControllerVentas{

    /*=============================================
    =MOSTRAR VENTAS=
    =============================================*/
    
    static public function ctl_MostrarVentas($column, $value){

        $respuesta = ModeloVentas::mdl_mostrarVentas($column, $value);

        return $respuesta;

    }

    /*=============================================
    =CREAR VENTAS=
    =============================================*/

    static public function ctl_CrearVenta(){

        if(isset($_POST['txt_registrarVenta_nuevaVenta'])){

            $TotalProductosComprados = [];

            /*=================================================================================
            =ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK, VENTAS DE LOS PRODUCTOS   =
            ==================================================================================*/
            
            $ListaProductos = json_decode($_POST['inp_listaProductos'], true);

            foreach ($ListaProductos as $key => $value) {

                array_push($TotalProductosComprados, $value['cantidad']);
                
                $item_0 = 'id_producto';
                $value_0 = $value['id'];

                $TraerProducto = ModelProductos::mdl_MostrarProductos('productos', $item_0, $value_0);

                $item_2 = 'ventas_producto';
                $value_2 = $value['cantidad'] + $TraerProducto['ventas_producto'];

                $ActualizarVentaProductos = ModelProductos::mdl_ModificarProducto($item_2, $value_2, $value_0);

                $item_3 = 'stock_producto';
                $value_3 = $value['stock'];

                $ActualizarVentaProductos = ModelProductos::mdl_ModificarProducto($item_3, $value_3, $value_0);

            }

            $item = 'id_cliente';

            $value = $_POST['cmbx_selectCliente'];

            $TraerCliente = ModelClientes::mdl_MostrarCliente($item, $value);

            $item_1 = 'compras_cliente';

            $value_1 = array_sum($TotalProductosComprados) + $TraerCliente['compras_cliente'];

            $ComprasCliente = ModelClientes::mdl_ModificarCliente($item_1, $value_1, $value);

            $item_2 = 'ultima_compra';

            // TRAIGO LA FECHA QUE SE CREO EL USUARIO PARA VOLVER A PONERLA SIN QUE SE MODIFIQUE POR LA ULTIMA COMPRA
            $FechaIngreoCliente = $TraerCliente["fecha_cliente"];

            date_default_timezone_set('America/Guayaquil');

            $fecha = date('Y-m-d');
            
            $hora = date('H:i:s'); //,strtotime( '-1 hour')

            $value_2 = $fecha.' '.$hora;

            $ComprasCliente = ModelClientes::mdl_ModificarCliente($item_2, $value_2, $value);

            /*=============================================
            =GUARDAR COMPRA=
            =============================================*/
            
            $data = array(
                'id_vendedor' => $_POST['txt_registrarVenta_IDuser'],
                'id_cliente' => $_POST['cmbx_selectCliente'],
                'codigo_venta' => $_POST['txt_registrarVenta_nuevaVenta'],
                'productos' => $_POST['inp_listaProductos'],
                'impuesto' => $_POST['txt_registrarVenta_PrecioImpuestoAguardar'],
                'neto' => $_POST['txt_registrarVenta_PrecioImpuestoNetoAguardar'],
                'total' => $_POST['txt_registrarVentaHD_NuevoTotalVenta'],
                'MetodPago' => $_POST['inpHD_listaMetodoPago']);

            $respuesta =  ModeloVentas::mdl_GuardarVenta($data);

            if($respuesta == 'ok'){

                echo '<script>

                        Swal.fire({
        
                            type:"success",
                            icon:"success",
                            title: "¡Venta registrada con éxito!",
                            showConfirmButton: true,
                            confirmButtonText:"Cerrar",
                            closeOnConfirm:false,
                            confirmButtonColor: "#3c8dbc"
        
                        }).then((result)=>{
        
                                if(result.value){
        
                                    window.location = "crear-venta";
        
                                }
        
                        })
    
                    </script>';

            }else{

                echo '<script>

                        Swal.fire({
        
                            type:"error",
                            icon: "error",
                            title: "¡Ha ocurrido un error al intentar guardar la venta!",
                            showConfirmButton: true,
                            confirmButtonText:"Cerrar",
                            closeOnConfirm:false
        
                        }).then((result)=>{
        
                                if(result.value){
        
                                    window.location = "crear-venta";
        
                                }
        
                        })

                </script>';


            }
            
            
        }

    }


    /*=============================================
    =EDITAR VENTA=
    =============================================*/

    static public function ctl_EditarVenta(){

        if(isset($_POST['txt_registrarVenta_EditarVenta'])){

            /*=============================================
            =FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES=
            =============================================*/

            $columnV = 'codigo_venta';
            
            $valueV = $_POST['txt_registrarVenta_EditarVenta'];
            
            $TraerVenta = ModeloVentas::mdl_mostrarVentas($columnV, $valueV);
            
            /*=============================================
            =REVISAR SI VIENEN PRODUCTOS EDITADOS=
            =============================================*/

            if($_POST['inp_listaProductos'] == ''){

                $ListToVoid = $TraerVenta['productos_venta'];
                $cambioProducto = false;

            }else{

                $ListToVoid = $_POST['inp_listaProductos'];
                $cambioProducto = true;

            }

            /*=======================================================
            =VALIDO SI SE ESTÁ HACINEDO MODIICACION DE PRODCTOS O NO=
            ========================================================*/

            if($cambioProducto){

                $ActualizarProductos = json_decode($TraerVenta["productos_venta"], true);

                $TotalProductosComprados = [];

                foreach ($ActualizarProductos as $key => $valueProducts) {

                    array_push($TotalProductosComprados, $valueProducts['cantidad']);
                    
                    $item_0 = 'id_producto';
                    $value_0 = $valueProducts['id'];

                    $TraerProducto = ModelProductos::mdl_MostrarProductos('productos', $item_0, $value_0);

                    $item_2 = 'ventas_producto';
                    $value_2 = $TraerProducto['ventas_producto'] - $valueProducts['cantidad'];

                    $ActualizarVentaProductos = ModelProductos::mdl_ModificarProducto($item_2, $value_2, $value_0);

                    $item_3 = 'stock_producto';
                    $value_3 = $valueProducts['cantidad'] + $TraerProducto['stock_producto'];

                    $ActualizarVentaProductos = ModelProductos::mdl_ModificarProducto($item_3, $value_3, $value_0);

                }

                $item_Cliente = 'id_cliente';

                $value_Cliente = $_POST['cmbx_selectCliente'];

                $TraerCliente = ModelClientes::mdl_MostrarCliente($item_Cliente, $value_Cliente);

                $item_2 = 'ultima_compra';

                $value_1 = $TraerCliente['compras_cliente'] - array_sum($TotalProductosComprados);

                $ComprasCliente = ModelClientes::mdl_ModificarCliente($item_2, $value_2, $value_Cliente);

                /*=================================================================================
                =ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK, VENTAS DE LOS PRODUCTOS   =
                ==================================================================================*/
                
                $ListaProductos_2 = json_decode($ListToVoid, true);
                
                $TotalProductosComprados_2 = [];

                foreach ($ListaProductos_2 as $key => $value) {

                    array_push($TotalProductosComprados_2, $value['cantidad']);
                    
                    $item_0_2 = 'id_producto';
                    $value_0_2 = $value['id'];

                    $TraerProducto_2 = ModelProductos::mdl_MostrarProductos('productos', $item_0_2, $value_0_2);

                    $item_2_2 = 'ventas_producto';
                    $value_2_2 = $value['cantidad'] + $TraerProducto_2['ventas_producto'];

                    $ActualizarVentaProductos = ModelProductos::mdl_ModificarProducto($item_2_2, $value_2_2, $value_0_2);

                    $item_3_2 = 'stock_producto';
                    $value_3_2 = $value['stock'];

                    $ActualizarVentaProductos_2 = ModelProductos::mdl_ModificarProducto($item_3_2, $value_3_2, $value_0_2);

                }

                $item_2 = 'id_cliente';

                $value_2 = $_POST['cmbx_selectCliente'];

                $TraerCliente_2 = ModelClientes::mdl_MostrarCliente($item_2, $value_2);

                $item_1_2 = 'compras_cliente';

                $value_1_2 = array_sum($TotalProductosComprados_2) + $TraerCliente_2['compras_cliente'];

                $ComprasCliente_2 = ModelClientes::mdl_ModificarCliente($item_1_2, $value_1_2, $value_2);

                $item_2_2 = 'ultima_compra';

                date_default_timezone_set('America/Guayaquil');

                $fecha_2 = date('Y-m-d');
                
                $hora_2 = date('H:i:s'); //,strtotime( '-1 hour')

                $value_2_2 = $fecha_2.' '.$hora_2;

                $ComprasCliente_2 = ModelClientes::mdl_ModificarCliente($item_2_2, $value_2_2, $value_2);
            }
            
            /*=============================================
            =GUARDAR CAMBISO DE COMPRA=
            =============================================*/
            
            $data = array(
                'id_vendedor' => $_POST['txt_registrarVenta_IDuser'],
                'id_cliente' => $_POST['cmbx_selectCliente'],
                'codigo_venta' => $_POST['txt_registrarVenta_EditarVenta'],
                'productos' => $ListToVoid,
                'impuesto' => $_POST['txt_registrarVenta_PrecioImpuestoAguardar'],
                'neto' => $_POST['txt_registrarVenta_PrecioImpuestoNetoAguardar'],
                'total' => $_POST['txt_registrarVentaHD_NuevoTotalVenta'],
                'MetodPago' => $_POST['inpHD_listaMetodoPago']);

            $respuesta =  ModeloVentas::mdl_EditarVenta($data);

            if($respuesta == 'ok'){

                echo '<script>

                        Swal.fire({
        
                            type:"success",
                            icon:"success",
                            title: "¡Venta Modificada con éxito!",
                            showConfirmButton: true,
                            confirmButtonText:"Cerrar",
                            closeOnConfirm:false,
                            confirmButtonColor: "#3c8dbc"
        
                        }).then((result)=>{
        
                                if(result.value){
        
                                    window.location = "ventas";
        
                                }
        
                        })
    
                    </script>';

            }else{

                echo '<script>

                        Swal.fire({
        
                            type:"error",
                            icon: "error",
                            title: "¡Ha ocurrido un error al intentar modificar la venta!",
                            showConfirmButton: true,
                            confirmButtonText:"Cerrar",
                            closeOnConfirm:false
        
                        }).then((result)=>{
        
                                if(result.value){
        
                                    window.location = "ventas";
        
                                }
        
                        })

                </script>';


            }
            
            
        }

    }

    /*=============================================
    =DELETE VENTA=
    =============================================*/
    
    static public function ctl_DeleteVenta(){

        if(isset($_GET['id_venta'])){

            $column_V = 'id_venta';
            $value_V = $_GET['id_venta'];

            $traerVenta = ModeloVentas::mdl_mostrarVentas($column_V, $value_V);

            /*=============================================
            =ACTUALIZAR ULTIMA COMPRA DEL CLIENTE=
            =============================================*/
            
            $itemVentas= null;
            $valueVentas = null;

            $traerVentas = ModeloVentas::mdl_mostrarVentas($itemVentas, $valueVentas);

            

            $GuardarFechas = array();
        
            foreach ($traerVentas as $key => $value) {
                
                if($value['id_cliente'] == $traerVenta['id_cliente']){

                    array_push($GuardarFechas ,$value['fecha']);

                }

            }

            if(count($GuardarFechas) > 1){

                if($traerVenta['id_cliente'] > $GuardarFechas[count($GuardarFechas) - 2]){

                    $column = 'ultima_compra';
                    
                    $valuee = $GuardarFechas[count($GuardarFechas) - 2];

                    $ClienteId = $traerVenta['id_cliente'];

                    $ClienteActualizarCompras = ModelClientes::mdl_ModificarCliente($column, $valuee, $ClienteId);
                    
                }else{

                    $column = 'ultima_compra';
                    
                    $valuee = $GuardarFechas[count($GuardarFechas) - 1];

                    $ClienteId = $traerVenta['id_cliente'];

                    $ClienteActualizarCompras = ModelClientes::mdl_ModificarCliente($column, $valuee, $ClienteId);

                }

            }else{

                $item = 'ultima_compra';
                
                $valor = '0000-00-00 00:00:00';

                $ClienteId = $traerVenta['id_cliente'];

                $ClienteActualizarCompras = ModelClientes::mdl_ModificarCliente($item, $valor, $ClienteId);

                echo $ClienteActualizarCompras;

            }

            $ActualizarProductos = json_decode($traerVenta["productos_venta"], true);

            $TotalProductosComprados = [];

            foreach ($ActualizarProductos as $key => $valueProducts) {

                array_push($TotalProductosComprados, $valueProducts['cantidad']);
                
                $item_0 = 'id_producto';
                $value_0 = $valueProducts['id'];

                $TraerProducto = ModelProductos::mdl_MostrarProductos('productos', $item_0, $value_0);

                $item_2 = 'ventas_producto';
                $value_2 = $TraerProducto['ventas_producto'] - $valueProducts['cantidad'];

                $ActualizarVentaProductos = ModelProductos::mdl_ModificarProducto($item_2, $value_2, $value_0);

                $item_3 = 'stock_producto';
                $value_3 = $valueProducts['cantidad'] + $TraerProducto['stock_producto'];

                $ActualizarVentaProductos = ModelProductos::mdl_ModificarProducto($item_3, $value_3, $value_0);

            }

            $item_Cliente = 'id_cliente';

            $value_Cliente = $traerVenta['id_cliente'];

            $TraerCliente = ModelClientes::mdl_MostrarCliente($item_Cliente, $value_Cliente);

            $item_2 = 'ultima_compra';

            $value_1 = $TraerCliente['compras_cliente'] - array_sum($TotalProductosComprados);

            $ComprasCliente = ModelClientes::mdl_ModificarCliente($item_2, $value_1, $value_Cliente);

            /*=============================================
            =ELIMINAR VENTA=
            =============================================*/
            
            $respuesta = ModeloVentas::mdl_EliminarVentas($value_V);

            if($respuesta == 'ok'){

                echo '<script>

                Swal.fire({

                    type:"success",
                    icon:"success",
                    title: "¡La venta ha sido borrada correctamente!",
                    showConfirmButton: true,
                    confirmButtonText:"Cerrar",
                    closeOnConfirm:false,
                    confirmButtonColor: "#3c8dbc"

                    }).then((result)=>{

                        if(result.value){

                            window.location = "ventas";

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

                            window.location = "ventas";

                        }

                    })

                </script>';

            }

        }

    }

    /*=============================================
    =RANGO DE FECHA=
    =============================================*/
    
    static public function ctl_RangoFechas($fechaIni, $fechaFin){

        $respuesta = ModeloVentas::mdl_RangoFechaVentas('ventas',$fechaIni, $fechaFin);

        return $respuesta;

    }

    /*=============================================
    =RANGO DE FECHA PARA REPORTES=
    =============================================*/
    
    static public function ctl_RangoFechasReportes($fechaIni, $fechaFin){

        $respuesta = ModeloVentas::mdl_RangoFechaVentasReportes($fechaIni, $fechaFin);

        return $respuesta;

    }

    /*=============================================
    =MOSTRAR VENDEDORES CON MAS VENTAS=
    =============================================*/
    
    static public function ctl_MostrarVendedorMasVentas(){

        $respuesta= ModeloVentas::mdl_MostrarVendedorMasVentas();

        return $respuesta;

    }

    /*=============================================
    =MOSTRAR CLIENTES CON MAS COMPRAS=
    =============================================*/
    
    static public function ctl_MostrarClientesMasCompras(){

        $respuesta= ModeloVentas::mdl_MostrarClientasMasCompras();

        return $respuesta;

    }

    /*=============================================
    =DESCARGAR REPORTE VENTAS EXCEL=
    =============================================*/
    
    static public function ctl_DescargarReporte(){

        if(isset($_GET["reporte"])){

            /*=============================================
            =CREAMOS ARCHIVO DE EXCEL=
            =============================================*/

            $Name =  $_GET["reporte"].".xls";

            header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition: attachment; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'><tr>
            <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td>
            <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
            <td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
            <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
            <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
            <td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
            <td style='font-weight:bold; border:1px solid #eee;'>NETO</td>
            <td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
            <td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td>
            <td style='font-weight:bold; border:1px solid #eee;'>FECHA</td></tr>");

            if(isset($_GET["fechaInicial"]) && isset($_GET["FechaFinal"])){

                $ventas = ModeloVentas::mdl_RangoFechaVentas("ventas",$_GET["fechaInicial"], $_GET["FechaFinal"]);

            }else{

                $ventas = ModeloVentas::mdl_mostrarVentas(null, null);

            }

            foreach ($ventas as $row => $item){

                $vendedor = ControllerUser::ctl_MostrarUsuarios("id_usuario", $item["id_vendedor"]);
                $cliente = ControllerClientes::ctl_mostrarCliente("id_cliente", $item["id_cliente"]);
                
                echo utf8_decode("<tr>
                <td style='border:1px solid #eee;'>".$item["codigo_venta"]."</td>
                <td style='border:1px solid #eee;'>".$cliente["nombre_cliente"]."</td>
                <td style='border:1px solid #eee;'>".$vendedor["nombre_usuario"]."</td>
                <td style='border:1px solid #eee;'>");

                $productos =  json_decode($item["productos_venta"], true);

                 foreach ($productos as $key => $valueProductos) {
                 
                 echo utf8_decode($valueProductos["cantidad"]."<br>");

                 }

                echo utf8_decode("</td><td style='border:1px solid #eee;'>");

                foreach ($productos as $key => $valueProductos) {
                 
                    echo utf8_decode($valueProductos["nombre"]."<br>");
                    
                }

                echo utf8_decode("</td>
                <td style='border:1px solid #eee;'>$ ".number_format($item["impuesto_venta"],2)."</td>
                <td style='border:1px solid #eee;'>$ ".number_format($item["neto_venta"],2)."</td>
                <td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
                <td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
                <td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td></tr>");

            }
            
            echo "</table>";



        }

    }

    /*=============================================
    =SUMA TOTAL DE EVENTAS=
    =============================================*/
    
    static public function ctl_MostrarTotalVentas(){

        $respuesta = ModeloVentas::mdl_MostrarVentasTotal();

        return $respuesta;

    }

}


?>