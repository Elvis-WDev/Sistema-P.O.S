<?php

require_once('conexion_bd.php');

class ModelCategory{

    /*=============================================
    =                   CREAR CATEGORIAS                   =
    =============================================*/
    
    static public function mdl_IngresarCategory($data){

        $Query = cls_conexion::conectar()->prepare('INSERT INTO categorias(categoria, fecha) VALUES(:category, now())');
        $Query -> bindParam(':category', $data, PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        };

        $Query -> close();

        $Query = null;


    }

        
    /*=============================================
    =                   MOSTRAR CATEGORIAS                   =
    =============================================*/
    
    static public function mdl_MostrarCategory($column, $value){

        if($column != null){

            $Query = cls_conexion::conectar()->prepare('SELECT * FROM categorias WHERE id_category = :valor');
            $Query -> bindParam(':valor', $value, PDO::PARAM_STR);

            $Query -> execute();

            return $Query -> fetch();

        }else{

            $Query = cls_conexion::conectar()->prepare('SELECT * FROM categorias');

            $Query -> execute();

            return $Query -> fetchAll();

        }

            $Query -> close();

            $Query = null;

    }


    
    /*=============================================
    =                   EDITAR CATEGORIAS                   =
    =============================================*/
    
    static public function mdl_EditarCategory($data){

        $Query = cls_conexion::conectar()->prepare('UPDATE categorias SET categoria = :category WHERE id_category = :id_category');
        $Query -> bindParam(':id_category', $data['id_category'], PDO::PARAM_STR);
        $Query -> bindParam(':category', $data['categoria'], PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        };

        $Query -> close();

        $Query = null;


    }

    /*=============================================
    =                   ELIMINAR CATEGORY                   =
    =============================================*/
    
    static public function mdl_EliminarCategory($data){

        $Query = cls_conexion::conectar()->prepare('DELETE FROM categorias WHERE id_category=:id_category');
        $Query -> bindParam(':id_category', $data, PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        };

        $Query -> close();

        $Query = null;

    }



}