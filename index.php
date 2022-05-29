<?php 

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', "php_error_log");

/*=============================================
=                   CONTROLADORES                   =
=============================================*/
require_once 'controllers/template-controller.php';
require_once 'controllers/usuarios-controller.php';
require_once 'controllers/categorias-controller.php';
require_once 'controllers/productos-controller.php';
require_once 'controllers/clientes-controller.php';
require_once 'controllers/ventas-controller.php';
/*============  End of CONTROLADORES  =============*/



/*=============================================
=                   MODELS                   =
=============================================*/
require_once 'models/usuarios-model.php';
require_once 'models/categorias-model.php';
require_once 'models/productos-model.php';
require_once 'models/clientes-model.php';
require_once 'models/ventas-model.php';
/*============  End of MODELS  =============*/



$template = new ControllerTemplate();
$template -> ctrTemplate();