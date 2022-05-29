<?php

require_once '../controllers/clientes-controller.php';
require_once '../models/clientes-model.php';

class ajaxClientes{

    /*=============================================
                    =EDITAR CLIENTE=
    =============================================*/

    public $id_client;

    public function ajaxClientesEditar(){

        $column = 'id_cliente';
        $value = $this->id_client;

        $respuesta = ControllerClientes::ctl_mostrarCliente($column, $value);

        echo json_encode($respuesta);

    }

}

/*=============================================
=                   EDITAR CLIENTE                   =
=============================================*/

if(isset($_POST['id-cliente'])){

    $editarCliente = new ajaxClientes();
    $editarCliente -> id_client = $_POST['id-cliente'];
    $editarCliente -> ajaxClientesEditar();

}