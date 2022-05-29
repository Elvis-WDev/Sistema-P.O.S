<?php

class cls_conexion{

    static public function conectar(){

        $link = new PDO('mysql:host=localhost;
                        dbname=sistema-pos',
                        'elvis',
                        'minecraft7');

        $link -> exec('set names utf8');

        return $link;

    }

}
