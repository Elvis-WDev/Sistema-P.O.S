
<?php

require_once("../controllers/categorias-controller.php");
require_once("../models/categorias-model.php");


class AjaxCategory{

    /*=============================================
    =                   EDITAR CATEGORIASS                   =
    =============================================*/
    public $id_category;

    public function ajax_editarCategoria(){

        $column = 'id_category';
        $value = $this ->  id_category;

        $respuesta = ControllerCategory::ctl_MostrarCategory($column, $value);

        echo json_encode($respuesta);

    }
    

}

/*=============================================
=                   EDITAR CATEGORIA                   =
=============================================*/

    if(isset($_POST['id_category'])){

        $categoria = new AjaxCategory();
        $categoria -> id_category = $_POST['id_category'];
        $categoria -> ajax_editarCategoria();
        
    }