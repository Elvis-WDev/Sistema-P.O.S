<?php


$ventas = ControllerVentas::ctl_MostrarTotalVentas();

$Category = ControllerCategory::ctl_MostrarCategory(null, null);
$TotalCategory = count($Category);

$clientes = ControllerClientes::ctl_mostrarCliente(null, null);
$TotalClients = count($clientes);

$productos = ControllerProducts::ctl_MostrarProductos(null, null);
$TotalProducts = count($productos);

?>


<!--=============================================
=CAJA PARA VENTAS=
=============================================-->

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3>$ <?= number_format($ventas["TotalNetoVentas"], 2); ?></h3>

      <p>Ventas</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="ventas" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<!--=============================================
=CAJA PARA CATEGORIAS=
=============================================-->

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3><?= '# '.number_format($TotalCategory); ?></h3>

      <p>Categorías</p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-clipboard"></i>
    
    </div>
    
    <a href="category" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<!--=============================================
=CAJA PARA CLIENTES=
=============================================-->

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?= '# '.number_format($TotalClients); ?></h3>

      <p>Clientes</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<!--=============================================
=CAJA PARA PRODUCTOS=
=============================================-->

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">
  
    <div class="inner">
    
      <h3><?= '# '.number_format($TotalProducts); ?></h3>

      <p>Productos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-ios-cart"></i>
    
    </div>
    
    <a href="productos" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>