

<?php

require_once("../controllers/productos-controller.php");
require_once("../models/productos-model.php");

class ajaxProductos{

    /*=============================================
    =CREAR CÓDIGO DEL PRODUCTO A PARTIR DE CATEGORÍA=
    =============================================*/
    public $id_Category;

    public function ajax_CrearCodigoProducto(){

        $column = "id_category";
        $value = $this->id_Category;

        $respuesta = ControllerProducts::ctl_MostrarProductos($column, $value);

        echo json_encode($respuesta);

    }

    /*=============================================
    =         TRAER PRODUCTO                   =
    =============================================*/

    public $id_product;
    public $TraerProductos;
    public $NameProduct;

     /*=============================================
    =EDITAR PRODUCTO=
    =============================================*/

    public $id_Producto;

    public function ajax_EditarProducto(){

        if($this->TraerProductos =='ok'){
            
            $column = null;
            $value = null;
    
            $respuesta = ControllerProducts::ctl_MostrarProductos($column, $value);
    
            echo json_encode($respuesta);

        }else if($this->NameProduct !=''){

            $column = "descripcion_producto";
            $value = $this->NameProduct;

            $respuesta = ControllerProducts::ctl_MostrarProductos($column, $value);

            echo json_encode($respuesta);

        }else{

            $column = "id_producto";
            $value = $this->id_Producto;

            $respuesta = ControllerProducts::ctl_MostrarProductos($column, $value);

            echo json_encode($respuesta);
        
        }

    }
    
}

/*=============================================
=CREAR CÓDIGO DEL PRODUCTO A PARTIR DE CATEGORÍA=
=============================================*/

if(isset($_POST['category_id'])){

    $codigoProducto = new ajaxProductos();
    $codigoProducto -> id_Category = $_POST['category_id'];
    $codigoProducto -> ajax_CrearCodigoProducto();

}


/*=============================================
=EDITAR PRODUCTO=
=============================================*/

if(isset($_POST['idProducto'])){

    $EditarProducto = new ajaxProductos();
    $EditarProducto -> id_Producto = $_POST['idProducto'];
    $EditarProducto -> ajax_EditarProducto();

}

/*=============================================
=TRAER PRODUCTO=
=============================================*/

if(isset($_POST['TraerProductos'])){

    $traerProducto = new ajaxProductos();
    $traerProducto -> TraerProductos = $_POST['TraerProductos'];
    $traerProducto -> ajax_EditarProducto();

}


/*=============================================
=CAPTURANDO PRODUCTO DEVICES=
=============================================*/

if(isset($_POST['NombreProducto'])){

    $EditarProducto = new ajaxProductos();
    $EditarProducto -> NameProduct = $_POST['NombreProducto'];
    $EditarProducto -> ajax_EditarProducto();

}





