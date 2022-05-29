<?php

$productos = ControllerProducts::ctl_MostrarProductosRecientes();

if($productos){
?>


<div class="box box-primary" style="border-top-color:#00c0ef">

    <div class="box-header with-border">

        <h3 class="box-title"><strong>Productos agregados recientemente</strong></h3>

    </div>

    <div class="box-body">

        <ul class="products-list product-list-in-box">

            <?php

    for($i = 0; $i < 10; $i++){

        if($productos[$i]["url_img_producto"] == ""){

            $UrlImg = "views/img/img_products/default/anonymous.png";
        
        }else{
            
            $UrlImg = $productos[$i]["url_img_producto"];
        
        }

        echo '<li class="item">

            <div class="product-img">

            <img src="'.$UrlImg.'" alt="Product Image">

            </div>

            <div class="product-info">

            <a href="javascript:void(0)" style="line-height:50px;text-decoration:none" class="product-title">

                '.$productos[$i]["descripcion_producto"].'

                <span class="label pull-right" style="margin-right:20px;color:#00a65a">$'.$productos[$i]["precio_venta_producto"].'</span>

            </a>
        
        </div>

        </li>';

    }

    ?>

        </ul>

    </div>

    <div class="box-footer text-center">

        <a style='text-decoration:none' href="productos" class="uppercase">Ver todos los productos</a>

    </div>

</div>

<?php

}

?>