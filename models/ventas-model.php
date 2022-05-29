<?php

require_once('conexion_bd.php');

class ModeloVentas{

    /*=============================================
    =MOSTRAR VENTAS=
    =============================================*/

    static public function mdl_mostrarVentas($column, $value){
        
        if($column != null){

            $Query = cls_conexion::conectar()->prepare('SELECT * FROM ventas WHERE '.$column.' = :valor ORDER BY id_venta DESC');

            $Query -> bindParam(':valor', $value, PDO::PARAM_STR);

            $Query -> execute();

            return $Query -> fetch();

        }else{

            $Query = cls_conexion::conectar()->prepare('SELECT * FROM ventas ORDER BY id_venta ASC');

            $Query -> execute();

            return $Query -> fetchAll();

        }

            $Query -> close();

            $Query = null;

    }

    /*=============================================
    =REGISTRO DE VENTA=
    =============================================*/

    static public function mdl_GuardarVenta($data){

        $Query = cls_conexion::conectar()->prepare('INSERT INTO ventas(codigo_venta, id_cliente, id_vendedor , productos_venta, impuesto_venta, neto_venta, total, metodo_pago)
        VALUES(:codigo_venta, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :MetodPago)');
            
        $Query -> bindParam(':id_vendedor', $data["id_vendedor"], PDO::PARAM_INT);
        $Query -> bindParam(':id_cliente', $data["id_cliente"], PDO::PARAM_INT);
        $Query -> bindParam(':codigo_venta', $data["codigo_venta"], PDO::PARAM_INT);
        $Query -> bindParam(':productos', $data["productos"], PDO::PARAM_STR);
        $Query -> bindParam(':impuesto', $data["impuesto"], PDO::PARAM_STR);
        $Query -> bindParam(':neto', $data["neto"], PDO::PARAM_STR);
        $Query -> bindParam(':total', $data["total"], PDO::PARAM_STR);
        $Query -> bindParam(':MetodPago', $data["MetodPago"], PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        }

        $Query -> close();

        $Query = null;

    }
    
    /*=============================================
    =EDITAR VENTA=
    =============================================*/

    static public function mdl_EditarVenta($data){

        $Query = cls_conexion::conectar()->prepare('UPDATE ventas SET id_cliente = :id_cliente, id_vendedor = :id_vendedor,
        productos_venta = :productos, impuesto_venta = :impuesto, neto_venta = :neto, total = :total, metodo_pago = :MetodPago WHERE codigo_venta = :codigo_venta');
            
        $Query -> bindParam(':id_vendedor', $data["id_vendedor"], PDO::PARAM_INT);
        $Query -> bindParam(':id_cliente', $data["id_cliente"], PDO::PARAM_INT);
        $Query -> bindParam(':codigo_venta', $data["codigo_venta"], PDO::PARAM_INT);
        $Query -> bindParam(':productos', $data["productos"], PDO::PARAM_STR);
        $Query -> bindParam(':impuesto', $data["impuesto"], PDO::PARAM_STR);
        $Query -> bindParam(':neto', $data["neto"], PDO::PARAM_STR);
        $Query -> bindParam(':total', $data["total"], PDO::PARAM_STR);
        $Query -> bindParam(':MetodPago', $data["MetodPago"], PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        }

        $Query -> close();

        $Query = null;

    }

    /*=============================================
    =ELIMINAR VENTA=
    =============================================*/
    
    static public function mdl_EliminarVentas($ID){

        $Query = cls_conexion::conectar()->prepare('DELETE FROM ventas WHERE id_venta = :id_venta');
            
        $Query -> bindParam(':id_venta', $ID, PDO::PARAM_INT);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        }

        $Query -> close();

        $Query = null;

    }

    /*=============================================
    =RENGO FECHAS=
    =============================================*/
    
    static public function mdl_RangoFechaVentas($tabla, $fechaInicial, $fechaFinal){
        
        if($fechaInicial == null){

			$stmt = cls_conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_venta ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = cls_conexion::conectar()->prepare("SELECT * FROM ventas WHERE fecha LIKE '%".$fechaInicial."%'");

			// $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = cls_conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = cls_conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

    }

    /*=============================================
    =RENGO FECHAS PARA REPORTES=
    =============================================*/
    
    static public function mdl_RangoFechaVentasReportes($fechaInicial, $fechaFinal){
        
        if($fechaInicial == null){

			$Query = cls_conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha,'%Y-%m-%d') fechaVenta, SUM(total) as totalVenta FROM ventas WHERE DATE_FORMAT(fecha, '%Y-%m-%d') GROUP BY YEAR(fecha), MONTH(fecha),DATE_FORMAT(fecha,'%Y-%m-%d'), total;");


		}else if($fechaInicial == $fechaFinal){

			$Query = cls_conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha,'%Y-%m-%d') fechaVenta, SUM(total) as totalVenta FROM ventas WHERE DATE_FORMAT(fecha, '%Y-%m-%d') BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' GROUP BY YEAR(fecha), MONTH(fecha),DATE_FORMAT(fecha,'%Y-%m-%d'), total;");
			
		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$Query = cls_conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha,'%Y-%m-%d') fechaVenta, SUM(total) as totalVenta FROM ventas WHERE DATE_FORMAT(fecha, '%Y-%m-%d') BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' GROUP BY YEAR(fecha), MONTH(fecha),DATE_FORMAT(fecha,'%Y-%m-%d'), total;");

			}else{


				$Query = cls_conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha,'%Y-%m-%d') fechaVenta, SUM(total) as totalVenta FROM ventas WHERE DATE_FORMAT(fecha, '%Y-%m-%d') BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' GROUP BY YEAR(fecha), MONTH(fecha),DATE_FORMAT(fecha,'%Y-%m-%d'), total;");

			}			

		}

        $Query -> execute();

		return $Query -> fetchAll();	

    }

    /*=============================================
    =MOSTRAR VENDEDOR CON MAS VENTAS=
    =============================================*/
    
    static public function mdl_MostrarVendedorMasVentas(){

        $Query = cls_conexion::conectar()->prepare("SELECT SUM(ventas.neto_venta) as TotalNeto, usuarios.nombre_usuario as nameuser, COUNT(*) as num_repeat FROM ventas INNER JOIN usuarios ON ventas.id_vendedor = usuarios.id_usuario GROUP BY usuarios.nombre_usuario HAVING COUNT(*) >= 1 ORDER BY SUM(ventas.neto_venta) DESC;");
        
        $Query -> execute();

		return $Query -> fetchAll();

    }

    /*=============================================
    =MOSTRAR CLIENTES CON MAS COMPRAS=
    =============================================*/
    
    static public function mdl_MostrarClientasMasCompras(){

        $Query = cls_conexion::conectar()->prepare("SELECT SUM(ventas.neto_venta) as TotalNeto, clientes.nombre_cliente as nameclient, COUNT(*) as num_repeat FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente GROUP BY clientes.nombre_cliente HAVING COUNT(*) >= 1 ORDER BY SUM(ventas.neto_venta) DESC");
        
        $Query -> execute();

		return $Query -> fetchAll();	

    }
    
    /*=============================================
    =MOSTRAR SUMA VENTAS TOTAL=
    =============================================*/
    
    static public function mdl_MostrarVentasTotal(){

        $Query = cls_conexion::conectar()->prepare("SELECT SUM(ventas.neto_venta) as TotalNetoVentas FROM ventas ORDER BY SUM(ventas.neto_venta) DESC");
        
        $Query -> execute();

		return $Query -> fetch();
        
        $Query -> close();

        $Query -> null;

    }

}
