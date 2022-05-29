<?php

session_start();

require_once ('../controllers/ventas-controller.php');
require_once ('../models/ventas-model.php');


require_once ('../controllers/clientes-controller.php');
require_once ('../models/clientes-model.php');


require_once ('../controllers/usuarios-controller.php');
require_once ('../models/usuarios-model.php');


class DTBL_AjaxVentas{

    /*=============================================
    =MOSTRAR TABLA VENTAS=
    =============================================*/

    public function DTBL_VentasTabla(){

        if($_POST["fecha_ini"] == '' && $_POST["fecha_fin"] == ''){

            $fechaINI = null;
            $fechaFIN =  null;
        
        }else{
    
            $fechaINI = $_POST["fecha_ini"];
            $fechaFIN =  $_POST["fecha_fin"];
        
        }
        
        $ventas = ControllerVentas::ctl_RangoFechas($fechaINI, $fechaFIN);

        if($ventas == null){
            
            $message = "NON-DATA";
        
            $data_Json = '{
                "data": [';

                $data_Json .='[
                    "'.$message.'"
                ]';

                    $data_Json .= ']}';

                    echo json_encode($data_Json);

        }else{

            $data_Json = '{
                "data": [';
        
            for($i = 0; $i < count($ventas); $i++){

                /*=============================================
                =TRAER CLIENTE=
                =============================================*/

                $column = 'id_cliente ';

                $value = $ventas[$i]["id_cliente"];
                
                $cliente = ModelClientes::mdl_MostrarCliente($column, $value);

                /*=============================================
                =TRAER VENDEDOR=
                =============================================*/

                $tabla = 'usuarios';

                $column_2 = 'id_usuario';

                $value_2 = $ventas[$i]["id_vendedor"];

                $vendedor = ModelUser::mdl_MostrarUser($tabla, $column_2, $value_2);

                /*=============================================
                =PERMISOS PARA ELIMINAR O EDITAR=
                =============================================*/
                
                if($_SESSION["perfil"] == "Administrador"){

                    $botones = "<div style='display:flex;justify-content:center; text-align:center;' class='btn-group d-grid gap-2 d-md-block''><button class='btn btn-info btn_ImprimirFactura' codigo_factura='".$ventas[$i]['codigo_venta']."'><i class='fa fa-print'></i></button><button class='btn btn-warning btn_EditarVenta_adm' id_venta='".$ventas[$i]['id_venta']."'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btn_EliminarVenta' id_venta='".$ventas[$i]['id_venta']."'><i class='fa fa-times'></i></button></div>";

                }else{

                    $botones = "<div style='display:flex;justify-content:center; text-align:center;' class='btn-group d-grid gap-2 d-md-block''><button class='btn btn-warning btn_EditarVenta_adm' id_venta='".$ventas[$i]['id_venta']."'><i class='fa fa-pencil'></i></button></div>";

                }

                /*=============================================
                =CONSTRUYO MI JSON=
                =============================================*/
                
                $data_Json .='[
                    "'.($i + 1).'",
                    "'.$ventas[$i]["codigo_venta"].'",
                    "'.$cliente['nombre_cliente'].'",
                    "'.strtoupper($vendedor['nombre_usuario']).'",
                    "'.$ventas[$i]["metodo_pago"].'",
                    "'.'$ '.number_format($ventas[$i]["impuesto_venta"], 2).'",
                    "'.'$ '.number_format($ventas[$i]["neto_venta"], 2).'",
                    "'.'$ '.number_format($ventas[$i]["total"], 2).'",
                    "'.$ventas[$i]["fecha"].'",
                    "'.$botones.'"
                ],';
            }

            $data_Json = substr($data_Json, 0, -1);
                $data_Json .= ']}';
            
            echo json_encode($data_Json);

        }

        return;

    }

}

/*=============================================
=       ACTIVAR TABLA DE VENTAS            =
=============================================*/

$activarProductos = new DTBL_AjaxVentas();
$activarProductos -> DTBL_VentasTabla();