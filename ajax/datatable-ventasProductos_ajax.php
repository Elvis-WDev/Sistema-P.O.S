<?php
require_once ('../controllers/productos-controller.php');
require_once ('../models/productos-model.php');

class DTBLVentasTableProductos{

    /*=============================================
    =            MOSTRAR TABLA PRODUCTOS         =
    =============================================*/
    
    public function DTBLVentasTablaProductos(){

        $column = null;
        $value = null;

        $productos = ControllerProducts::ctl_MostrarProductos($column, $value);

        if($productos){

            $data_Json = '{
                "data": [';
      
                for($i = 0; $i < count($productos); $i++){
    
                    /*=============================================
                    =MUESTRO LA TABLA DE PRODUCTOS=
                    =============================================*/
    
                    $botones = "<div class='btn-group'><button type='button' class='btn btn-primary btnAgregarProducto btn-RecuperarButton' data-id-product='".$productos[$i]["id_producto"]."'><i class='fas fa-plus-square'></i> Agregar</button></div>";
    
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
    
                    // $column = 'id_category';
                    // $value =  $productos[$i]["id_category"];
    
                    // $categorias = ControllerCategory::ctl_MostrarCategory($column, $value);
                    
                    $data_Json .='[
                        "'.($i + 1).'",
                        "'.$imagen.'",
                        "'.$productos[$i]["codigo_producto"].'",
                        "'.$productos[$i]["descripcion_producto"].'",
                        "'.$stock.'",
                        "'.'$ '.number_format($productos[$i]["precio_venta_producto"], 2).'",
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
                "----"
                ]';

            $data_Json .= ']}';

        }

        echo $data_Json;
        
        return;

    }
}

/*=============================================
=       ACTIVAR TABLA DE PRODUCTOS            =
=============================================*/

$activarProductos = new DTBLVentasTableProductos();
$activarProductos -> DTBLVentasTablaProductos();