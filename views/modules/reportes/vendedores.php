<?php

$ventas = ControllerVentas::ctl_MostrarVendedorMasVentas();


if($ventas){
?>

<!--=====================================
VENDEDORES
======================================-->

<div class="box box-info">

    <div class="box-header with-border">

        <h3 class="box-title"><strong>Vendedores</strong></h3>

    </div>

    <div class="box-body">

        <div class="chart-responsive">

            <div class="chart" id="bar-chart1" style="height: 300px;"></div>

        </div>

    </div>

</div>

<script>
//BAR CHART
var bar = new Morris.Bar({
    element: 'bar-chart1',
    resize: true,
    data: [

        <?php
    
    foreach($ventas as $key => $value){

      echo "{y: '".$value['nameuser']."', a: '".$value['TotalNeto']."'},";

    }

  ?>

    ],
    barColors: ['#2CA9FF'],
    xkey: 'y',
    ykeys: ['a'],
    labels: ['Ventas'],
    preUnits: '$',
    hideHover: 'auto'
});
</script>

<?php

}

?>