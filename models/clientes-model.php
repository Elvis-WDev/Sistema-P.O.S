<?php

require_once('conexion_bd.php');

class ModelClientes{

    /*=============================================
    =                   GUARDAR CLIENTE=
    =============================================*/
    
    static public function mdl_crearCliente($data){

         
        $Query = cls_conexion::conectar()->prepare('INSERT INTO clientes(nombre_cliente, documento_cliente, email_cliente, telefono_cliente, direccion_cliente, fecha_nacimiento_cliente, fecha_cliente)
        VALUES(:nameC, :dni, :email, :telefono, :direccion, :fecha_nacimiento, :fechaActual)');
            
        $Query -> bindParam(':nameC', $data['nombre'], PDO::PARAM_STR);
        $Query -> bindParam(':dni', $data['cedula'], PDO::PARAM_STR);
        $Query -> bindParam(':email', $data['email'], PDO::PARAM_STR);
        $Query -> bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        $Query -> bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
        $Query -> bindParam(':fechaActual', $data['fechaActual'], PDO::PARAM_STR);
        $Query -> bindParam(':fecha_nacimiento', $data['fecha_nacimiento'], PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        }

        $Query -> close();

        $Query = null;

    }

     /*=============================================
    =                   EDITAR CLIENTE=
    =============================================*/
    
    static public function mdl_EditCliente($data){

         
        $Query = cls_conexion::conectar()->prepare('UPDATE clientes SET nombre_cliente=:nameC, documento_cliente=:dni, email_cliente=:email,
        telefono_cliente=:telefono, direccion_cliente=:direccion, fecha_nacimiento_cliente=:fecha_nacimiento, 
        fecha_cliente=:fecha_registro WHERE id_cliente=:id');
        
        $Query -> bindParam(':id', $data['id'], PDO::PARAM_INT);
        $Query -> bindParam(':nameC', $data['nombre'], PDO::PARAM_STR);
        $Query -> bindParam(':dni', $data['cedula'], PDO::PARAM_STR);
        $Query -> bindParam(':email', $data['email'], PDO::PARAM_STR);
        $Query -> bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        $Query -> bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
        $Query -> bindParam(':fecha_nacimiento', $data['fecha_nacimiento'], PDO::PARAM_STR);
        $Query -> bindParam(':fecha_registro', $data['fecha_registro'], PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        }

        $Query -> close();

        $Query = null;

    }

     /*=============================================
    =                   MOSTRAR CLIENTE
    =============================================*/
    
    static public function mdl_MostrarCliente($column, $value){

        if($column != null){

            $Query = cls_conexion::conectar()->prepare('SELECT * FROM clientes WHERE '.$column.'= :value');
                
            $Query -> bindParam(':value', $value, PDO::PARAM_STR);

            $Query -> execute();

            return $Query -> fetch();

        }else{

            $Query = cls_conexion::conectar()->prepare('SELECT * FROM clientes');
                
            $Query -> execute();

            return $Query -> fetchAll();

        }
        
        $Query -> close();

        $Query = null;

    }
    
     /*=============================================
    =                   DELETE CLIENTE
    =============================================*/
    
    static public function mdl_DeleteCliente($value){

        $Query = cls_conexion::conectar()->prepare('DELETE FROM clientes WHERE id_cliente = :valor');
                
        $Query -> bindParam(':valor', $value, PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        }

        $Query -> close();

        $Query = null;

    }

    
      /*=============================================
    = ACTUALIZAR CLIENTE (COMPRAS)=
    =============================================*/

    static public function mdl_ModificarCliente($item1, $value1, $value2){

        $Query = cls_conexion::conectar()->prepare('UPDATE clientes SET '.$item1.' = :value1 WHERE id_cliente = :value2');

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

}