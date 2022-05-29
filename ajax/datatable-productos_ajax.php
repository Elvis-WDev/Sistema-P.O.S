<?php

session_start();

require_once ('../controllers/productos-controller.php');
require_once ('../models/productos-model.php');

require_once ('../controllers/categorias-controller.php');
require_once ('../models/categorias-model.php');

class TableProductos{

    /*=============================================
    =                   MOSTRAR TABLA PRODUCTOS                   =
    =============================================*/
    
    public function mostrarTablaProductos(){

        $column = null;
        $value = null;

        $productos = ControllerProducts::ctl_MostrarProductos($column, $value);

        if($productos){

            $data_Json = '{
                "data": [';
      
                for($i = 0; $i < count($productos); $i++){
    
                    /*=============================================
                    =PERMISOS PARA BOTONES DE PRODUCTOS=
                    =============================================*/
                    
                    if($_SESSION["perfil"] == "Especial"){
    
                        $botones = "<div style='display:flex;justify-content:center; text-align:center;' class='btn-group d-grid gap-2 d-md-block'><button class='btn btn-warning btn_EditarProducto' id-producto_editar='".$productos[$i]["id_producto"]."' data-bs-toggle='modal' data-bs-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>";
    
                    }else{
    
                        $botones = "<div style='display:flex;justify-content:center; text-align:center;' class='btn-group d-grid gap-2 d-md-block'><button class='btn btn-warning btn_EditarProducto' id-producto_editar='".$productos[$i]["id_producto"]."' data-bs-toggle='modal' data-bs-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btn_DeleteProducto' id-producto-delete='".$productos[$i]["id_producto"]."' data-codigo_producto='".$productos[$i]["codigo_producto"]."' data-url_img='".$productos[$i]["url_img_producto"]."'><i class='fa fa-times'></i></button></div>";
    
                    }
    
                    /*=============================================
                    =VALIDO SI MI IMAGEN EXISTE O NO=
                    =============================================*/
    
                    if($productos[$i]["url_img_producto"] != ''){
    
                        $imagen = "<img src='".$productos[$i]["url_img_producto"]."' class='img-thumbnail' width='50px' alt=''>";
    
                    }else{
    
                        $imagen = "<img src='views/img/img_products/default/anonymous.png' class='img-thumbnail' width='50px' alt=''>";
                    
                    }
                    /*=============================================
                    =stock=
                    =============================================*/
    
                    if($productos[$i]["stock_producto"] <= 5){
    
                        $stock = "<button class='btn btn-danger'>".$productos[$i]["stock_producto"]."</button>";
             
                    }else if($productos[$i]["stock_producto"] >= 6 && $productos[$i]["stock_producto"] <= 12){
    
                        $stock = "<button class='btn btn-warning'>".$productos[$i]["stock_producto"]."</button>";
    
                    }else{
    
                        $stock = "<button class='btn btn-success'>".$productos[$i]["stock_producto"]."</button>";
    
                    }
    
                   
                    /*=============================================
                    =TRAIGO MI CATEGORIA=
                    =============================================*/
    
                    $column = 'id_category';
                    $value =  $productos[$i]["id_category"];
    
                    $categorias = ControllerCategory::ctl_MostrarCategory($column, $value);
                    
                    $data_Json .='[
                        "'.($i + 1).'",
                        "'.$imagen.'",
                        "'.$productos[$i]["codigo_producto"].'",
                        "'.strtoupper($productos[$i]["descripcion_producto"]).'",
                        "'.strtoupper($categorias["categoria"]).'",
                        "'.$stock.'",
                        "'.'$ '.number_format($productos[$i]["precio_compra_producto"]).'",
                        "'.'$ '.number_format($productos[$i]["precio_venta_producto"]).'",
                        "'.$productos[$i]["fecha"].'",
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
                "----"
                ]';
                      
            $data_Json .= ']}';
        

        }

        
        echo $data_Json;
        
        return;

    }
}

/*=============================================
=       ACTIVAR TABLA DE PRODUCTOS                   =
=============================================*/

$activarProductos = new TableProductos();
$activarProductos -> mostrarTablaProductos();