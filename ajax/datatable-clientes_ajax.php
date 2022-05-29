<?php
session_start();
require_once ('../controllers/clientes-controller.php');
require_once ('../models/clientes-model.php');

class ajax_datatable_clientes{

    /*=============================================
    =                   MOSTRAR CLIENTE                   =
    =============================================*/

    public function ajax_MostrarTablaClientes(){

        $column = null;
        $value = null;
    
        $clientes = ControllerClientes::ctl_mostrarCliente($column, $value);

        if($clientes){

            $data_Json = '{
                "data": [';
    
            /*=============================================
            =PERMISOS PARA BOTON DELETE=
            =============================================*/
            
            for($i = 0; $i < count($clientes); $i++){
    
                if($_SESSION["perfil"] == "Administrador"){
    
                    $btnDelete = "<button class='btn btn-danger btn_DeleteCliente' id-cliente='".$clientes[$i]['id_cliente']."'><i class='fa fa-times'></i></button>";
        
                }else{
        
                    $btnDelete = "";
        
                }
    
                $botones = "<div style='display:flex;justify-content:center; text-align:center;' class='btn-group d-grid gap-2 d-md-block'><button class='btn btn-warning btn_EditarCliente' data-bs-toggle='modal' data-bs-target='#modalEditarCliente' id-cliente='".$clientes[$i]['id_cliente']."'><i class='fa fa-pencil'></i></button>".$btnDelete."</div>";
                
                $data_Json .='[
                    "'.($i + 1).'",
                    "'.$clientes[$i]["nombre_cliente"].'",
                    "'.$clientes[$i]["documento_cliente"].'",
                    "'.$clientes[$i]["email_cliente"].'",
                    "'.$clientes[$i]["telefono_cliente"].'",
                    "'.$clientes[$i]["direccion_cliente"].'",
                    "'.$clientes[$i]["fecha_nacimiento_cliente"].'",
                    "'.$clientes[$i]["compras_cliente"].'",
                    "'.$clientes[$i]["ultima_compra"].'",
                    "'.$clientes[$i]["fecha_cliente"].'",
                    "'.$botones.'"
                  ],';
        
            }
    
            $data_Json = substr($data_Json, 0, -1);
            $data_Json .= ']}';

        }else{

            $data_Json = '{
                "data": [';
    
                $data_Json .='[
                    "----",
                    "----",
                    "----",
                    "----",
                    "----",
                    "----",
                    "----",
                    "----",
                    "----",
                    "----",
                    "----"
                  ]';
    
            $data_Json .= ']}';

        }
    
        echo $data_Json;
    
        return;

    }

}

/*=============================================
=                  MOSTRAR CLIENTES                   =
=============================================*/

$activarClientes = new ajax_datatable_clientes();
$activarClientes -> ajax_MostrarTablaClientes();