<?php

require_once('conexion_bd.php');

class ModelUser{
    
    /*=============================================
    =                   MOSTRAR USUARIOS                   =
    =============================================*/

    static public function mdl_MostrarUser($tabla, $column, $value){

       if($column != null){

            $Query = cls_conexion::conectar()->prepare('SELECT * FROM '.$tabla.' WHERE '.$column.' = :txt_user_login');
            
            $Query -> bindParam(':txt_user_login', $value, PDO::PARAM_STR);

            $Query -> execute();

            return $Query -> fetch();


       }else if($column == null){
        
            $Query = cls_conexion::conectar()->prepare('SELECT * FROM usuarios');

            $Query -> execute();

            return $Query -> fetchAll();

       }
        
        $Query -> close();

        $Query = null;

    }
    
    /*============  End of MOSTRAR USUARIOS  =============*/
    




     /*=============================================
    =                   REGISTRAR USUARIOS                   =
    =============================================*/

    static public function mdl_registrarUsuario($data){

        $Query = cls_conexion::conectar()->prepare('INSERT INTO usuarios(nombre_usuario, usuario, password_usuario, perfil_usuario, foto_usuario) 
        VALUES(:nombre, :usuario, :passwd, :perfil, :foto_user)');
        
        $Query -> bindParam(':nombre', $data['nombre_usuario'], PDO::PARAM_STR);
        $Query -> bindParam(':usuario', $data['usuario'], PDO::PARAM_STR);
        $Query -> bindParam(':passwd', $data['password_usuario'], PDO::PARAM_STR);
        $Query -> bindParam(':perfil', $data['perfil_usuario'], PDO::PARAM_STR);
        $Query -> bindParam(':foto_user', $data['ruta'], PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        };

        $Query -> close();

        $Query = null;

    }
    
    /*============  End of REGISTRAR USUARIOS  =============*/
    


    /*=============================================
    =                   MODIFICAR USUARIOS        =
    =============================================*/

    static public function mdl_EditarUsuario($data){

        $Query = cls_conexion::conectar()->prepare('UPDATE usuarios SET nombre_usuario=:nombre,
         password_usuario=:passwd, perfil_usuario=:perfil, foto_usuario=:foto_user WHERE usuario=:usuario');
        
        $Query -> bindParam(':nombre', $data['nombre_usuario'], PDO::PARAM_STR);
        $Query -> bindParam(':usuario', $data['usuario'], PDO::PARAM_STR);
        $Query -> bindParam(':passwd', $data['password_usuario'], PDO::PARAM_STR);
        $Query -> bindParam(':perfil', $data['perfil_usuario'], PDO::PARAM_STR);
        $Query -> bindParam(':foto_user', $data['ruta'], PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        };

        $Query -> close();

        $Query = null;

    }


     /*=============================================
    = Editar USUARIOS (ACTIVAR AND LAST-LOGIN)     =
    =============================================*/

    static public function mdl_ModificarUsuario($item1, $value1, $item2, $value2){

        $Query = cls_conexion::conectar()->prepare('UPDATE usuarios SET '.$item1.' = :value1 WHERE '.$item2.' = :value2');

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
    =   ELIMINAR USUARIOS      =
    =============================================*/
    
    static public function mdl_DeleteUsuario($data){

        $Query = cls_conexion::conectar()->prepare('DELETE FROM usuarios WHERE id_usuario = :id_user');
        
        $Query -> bindParam(':id_user', $data ,PDO::PARAM_STR);

        if($Query -> execute()){

            return 'ok';

        }else{

            return 'error';

        };

        $Query -> close();

        $Query = null;

    }

}