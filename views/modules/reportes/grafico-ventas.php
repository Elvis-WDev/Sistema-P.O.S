<?php

// error_reporting(0);
$arrayFecha = array();
$arrayVentas = array();
$SumaPagoMes = array();

if(isset($_GET["fechaStart"])){

    $fechaInicial = $_GET["fechaStart"];
    $fechaFinal = $_GET["fechaEnd"];

}else{

    $fechaInicial = null;
    $fechaFinal = null;

}

$respuesta = ControllerVentas::ctl_RangoFechasReportes($fechaInicial, $fechaFinal);

?>


<!--/*=============================================
 =GRAFICO DE VENTAS=
 =============================================*/-->

<div class="box box-solid bg-blue-gradient">

    <div class="box-header">

        <i class="fa fa-th"></i>

        <h3 class="box-title">Gráfico de Ventas</h3>

    </div>

    <div class="box-body border-radius-none nuevoGraficoVentas">

        <div class="chart" id="line-chart-ventas" style="height: 250px;"></div>

    </div>

</div>


<script>
var line = new Morris.Line({
    element: 'line-chart-ventas',
    resize: true,
    data: [

        <?php
           
           if($respuesta){

            foreach ($respuesta as $key => $value) {

                $TotalVentaN = round($value['totalVenta'], 2);

                echo "{y: '".$value['fechaVenta']."', ventas: '".$TotalVentaN."'},";

            }

           }else{

            echo "{y: '0', ventas: '0'}";

           }



        ?>

    ],
    xkey: 'y',
    ykeys: ['ventas'],
    labels: ['<strong>Ventas</strong>'],
    // xLabels          : ['decade'],
    lineColors: ['#F2F2F2'],
    lineWidth: 3,
    hideHover: 'auto',
    gridTextColor: '#fff',
    gridStrokeWidth: 0.5,
    pointSize: 5,
    pointStrokeColors: ['#efefef'],
    gridLineColor: '#efefef',
    gridTextFamily: 'Open Sans',
    preUnits: '$',
    gridTextSize: 12

});
</script>