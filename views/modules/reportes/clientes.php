<?php

$ventas = ControllerVentas::ctl_MostrarClientesMasCompras();

if($ventas){

?>

<!--=====================================
CLIENTES
======================================-->

<div class="box box-info">

    <div class="box-header with-border">

        <h3 class="box-title"><strong class="title_pages">Clientes</strong></h3>

    </div>

    <div class="box-body">

        <div class="chart-responsive">

            <div class="chart" id="bar-chart2" style="height: 300px;"></div>

        </div>

    </div>

</div>


<script>
//BAR CHART
var bar = new Morris.Bar({
    element: 'bar-chart2',
    resize: true,
    data: [

        <?php
    
    foreach($ventas as $key => $value){

      echo "{y: '".$value['nameclient']."', a: '".$value['TotalNeto']."'},";

    }

  ?>

    ],
    barColors: ['#7542FF'],
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