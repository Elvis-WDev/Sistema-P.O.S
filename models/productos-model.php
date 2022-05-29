<?php

require_once('conexion_bd.php');

class ModelProductos{

    /*=============================================
    =                   MOSTRAR PRODUCTOS                   =
    =============================================*/
    
    static public function mdl_MostrarProductos($tabla, $column, $value){

        if($column != ''){

            $Query = cls_conexion::conectar()->prepare('SELECT * FROM '.$tabla.' WHERE '.$column.' = :valor ORDER BY id_producto DESC');
            
            $Query -> bindParam(':valor', $value, PDO::PARAM_STR);

            $Query -> execute();

            return $Query -> fetch();


        }else{

            
            $Query = cls_conexion::conectar()->prepare('SELECT * FROM '.$tabla.'');

            $Query -> execute();

            return $Query -> fetchAll();

        }
        
        $Query -> close();

        $Query = null;
        
    }

     /*=============================================
    =                   MOSTRAR PRODUCTOS REPORTES                   =
    =============================================*/
    
    static public function mdl_MostrarProductosReportes($tabla, $column, $value, $order){
            
        $Query = cls_conexion::conectar()->prepare('SELECT * FROM '.$tabla.' ORDER BY '.$order.' DESC');

        $Query -> execute();

        return $Query -> fetchAll();
        
        $Query -> close();

        $Query = null;
        
    }

     /*=============================================
    =        REGISTRAR PRODUCTOS                   =
    =============================================*/

    static public function mdl_RegistrarPoducto($data){

        
        $Query = cls_conexion::conectar()->prepare('INSERT INTO productos(id_category, codigo_producto, 
        descripcion_producto, url_img_producto, stock_producto, precio_compra_producto, 
        precio_venta_producto, fecha) VALUES(:category, :codigo, :descripcion, :url_img, :stock, :precio_compra, :precio_venta, now())');
            
        $Query -> bindParam(':category', $data["category"], PDO::PARAM_INT);
        $Query -> bindParam(':codigo', $data["codigo_producto"], PDO::PARAM_STR);
        $Query -> bindParam(':descripcion', $data["descripcion_producto"], PDO::PARAM_STR);
        $Query -> bindParam(':url_img', $data["url_img"], PDO::PARAM_STR);
        $Query -> bindParam(':stock', $data["stock_producto"], PDO::PARAM_STR);
        $Query -> bindParam(':precio_compra', $data["precioCompra_producto"], PDO::PARAM_STR);
        $Query -> bindParam(':precio_venta', $data["precioVenta_producto"], PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        }

        $Query -> close();

        $Query = null;

    }

     /*=============================================
    =        EDITAR PRODUCTOS                   =
    =============================================*/

    static public function mdl_EditarPoducto($data){
        
        $Query = cls_conexion::conectar()->prepare('UPDATE productos SET id_category = :category, descripcion_producto = :descripcion,
        url_img_producto = :url_img, stock_producto = :stock, precio_compra_producto = :precio_compra, 
        precio_venta_producto = :precio_venta WHERE codigo_producto = :codigo');
            
        $Query -> bindParam(':category', $data["category"], PDO::PARAM_INT);
        $Query -> bindParam(':codigo', $data["codigo_producto"], PDO::PARAM_STR);
        $Query -> bindParam(':descripcion', $data["descripcion_producto"], PDO::PARAM_STR);
        $Query -> bindParam(':url_img', $data["url_img"], PDO::PARAM_STR);
        $Query -> bindParam(':stock', $data["stock_producto"], PDO::PARAM_STR);
        $Query -> bindParam(':precio_compra', $data["precioCompra_producto"], PDO::PARAM_STR);
        $Query -> bindParam(':precio_venta', $data["precioVenta_producto"], PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        }

        $Query -> close();

        $Query = null;

    }

      /*=============================================
    =        DELETE PRODUCTOS                   =
    =============================================*/

    static public function mdl_DeletePoducto($data){
        
        $Query = cls_conexion::conectar()->prepare('DELETE FROM productos WHERE id_producto = :id_prod');
            
        $Query -> bindParam(':id_prod', $data, PDO::PARAM_INT);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        }

        $Query -> close();

        $Query = null;

    }

      /*=============================================
    = ACTUALIZAR PRODUCTOS=
    =============================================*/

    static public function mdl_ModificarProducto($item1, $value1, $value2){

        $Query = cls_conexion::conectar()->prepare('UPDATE productos SET '.$item1.' = :value1 WHERE id_producto = :value2');

        $Query -> bindParam(':value1', $value1 ,PDO::PARAM_STR);
        $Query -> bindParam(':value2', $value2 ,PDO::PARAM_STR);


        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        };

        $Query -> close();

        $Query = null;

    }

    /*=============================================
    =MOSTRAR SUMA VENTAS=
    =============================================*/
    
    static public function mdl_MostrarSumarVentas($tabla){

        $Query = cls_conexion::conectar()->prepare('SELECT SUM(ventas_producto) as total FROM '.$tabla.'');

        $Query -> execute();

		return $Query -> fetch();

		$Query -> close();

		$Query = null;


    }

    /*=============================================
    =MOSTRAR PRODUCTOS RECIENTES=
    =============================================*/
    
    static public function mdl_MostrarProductosRecientes(){

        $Query = cls_conexion::conectar()->prepare('SELECT * FROM productos ORDER BY id_producto DESC');

        $Query -> execute();

        return $Query -> fetchAll();
        
        $Query -> close();

        $Query = null;
        
    }

}