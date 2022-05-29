<?php


require_once('../../../controllers/ventas-controller.php');
require_once('../../../models/ventas-model.php');

require_once('../../../controllers/productos-controller.php');
require_once('../../../models/productos-model.php');

require_once('../../../controllers/clientes-controller.php');
require_once('../../../models/clientes-model.php');

require_once('../../../controllers/usuarios-controller.php');
require_once('../../../models/usuarios-model.php');

class ImprimirFactura{
    
public $codigo;

public function TraerDatosVenta(){

/*=============================================
=TRAEMOS INFO DE LA VENTA=
=============================================*/

$columnVenta = "codigo_venta";

$valueVenta = $this->codigo;

$respuestaVenta =  ModeloVentas::mdl_mostrarVentas($columnVenta, $valueVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos_venta"], true);
$neto = number_format($respuestaVenta["neto_venta"],2);
$impuesto = number_format($respuestaVenta["impuesto_venta"],2);
$total = number_format($respuestaVenta["total"],2);

/*=============================================
=TRAEMOS INFO DEL CLIENTE=
=============================================*/

$columnCliente = "id_cliente";

$valueCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControllerClientes::ctl_mostrarCliente($columnCliente, $valueCliente);

/*=============================================
=TRAEMOS INFO DEL VENDEDOR=
=============================================*/

$columnVendedor = "id_usuario";

$valueVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControllerUser::ctl_MostrarUsuarios($columnVendedor, $valueVendedor);

require_once("../examples/tcpdf_include.php");

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);

$pdf->startPageGroup();

$pdf->AddPage();

$bloque1 = <<<EOF

        <table>
                
            <tr>
                
                <td style="width:150px;"><br><br><img src="imgs/logo_empresa.png" width="125px"></td>

                <td style="background-color:white; width:140px">
                    
                    <div style="font-size:8.5px; text-align:left; line-height:15px;">
                        
                        <br>
                        <strong>NIT:</strong> 71.759.963-9

                        <br>
                        <strong>Dirección:</strong> Calle Hernesto Nieto Y Ana Merchán.

                    </div>

                </td>

                <td style="background-color:white; width:140px">

                    <div style="font-size:8.5px; text-align:left; line-height:15px;">
                        
                        <br>
                        <strong>Teléfono:</strong> +593 9839 873 21
                        
                        <br>
                        <strong>Mail:</strong> maicol-elvis@hotmail.com

                    </div>
                    
                </td>

                <td style="background-color:white; width:110px; text-align:center; color:#000000"><br><br><strong>FACTURA N.</strong><br><br># $valueVenta</td>

            </tr>

        </table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, "");

/*=============================================
=OTRO BLOQUE=
=============================================*/

$bloque2 = <<<EOF

        <table>
                
            <tr>
                
                <td style="width:540px"><img src="images/back.jpg"></td>

            </tr>

        </table>

        <table style="font-size:10px; padding:5px 10px;">

            <tr>

                <td style="border: 1px solid #666;background-color:white; width:390px"><strong>Cliente:</strong> $respuestaCliente[nombre_cliente]</td>

                <td style="border: 1px solid #666; background-color:white; width:150px; text-align:left">
                
                <strong>Fecha:</strong> $fecha

                </td>

            </tr>

            <tr>

                <td style="border: 1px solid #666; background-color:white; width:540px"><strong>Vendedor:</strong> $respuestaVendedor[nombre_usuario]</td>

            </tr>

            <tr>

                <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

            </tr>

        </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, "");

/*=============================================
=OTRO BLOQUE=
=============================================*/

$bloque3 = <<<EOF
        <table style="font-size:10px; padding:5px 10px;">

            <tr>

                <td style="border: 1px solid #666; background-color:white; width:260px; text-align:center"><strong>Producto</strong></td>
                <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Cantidad</strong></td>
                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><strong>Valor Unit.</strong></td>
                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><strong>Valor Total</strong></td>

            </tr>

        </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, "");

/*=============================================
=OTRO BLOQUE=
=============================================*/

foreach ($productos as $key => $prod) {

$column = "id_producto";

$value = $prod["id"];

$ProductoSeleccionado = ControllerProducts::ctl_MostrarProductos($column, $value);

$valorUnitario = number_format($ProductoSeleccionado["precio_venta_producto"], 2);

$precioTotal = number_format($prod["precioTotalProduct"], 2);

$bloque4 = <<<EOF

        <table style="font-size:10px; padding:5px 10px;">

            <tr>
                
                <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                    $prod[nombre]
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                    $prod[cantidad]
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                    $valorUnitario
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                    $precioTotal
                </td>

            </tr>

        </table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, "");

}


$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				<strong>Neto:</strong>
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
            <strong>Impuesto:</strong>
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
                <strong>Total:</strong>
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

//LIMPIA EL BUFER DE SALIDA ANTE CUALQUIER ERROR
ob_end_clean();

/*=============================================
=SALIDA ARCHIVO=
=============================================*/

date_default_timezone_set('America/Guayaquil');

$fecha = date('Y-m-d');

$hora = date('H:i:s'); //,strtotime( '-1 hour')

$FechaActual= $fecha.' '.$hora;

$nameFile = "Factura_".$FechaActual."_".$this->codigo.".pdf";
$pdf->Output($nameFile);

}

}

/*=============================================
=CAPTURO MI VARIABLE GET QUE LLEGA CON EL BOTON=
=============================================*/

$Factura = new ImprimirFactura();
$Factura -> codigo = $_GET["codigoF"];
$Factura -> TraerDatosVenta();

?>