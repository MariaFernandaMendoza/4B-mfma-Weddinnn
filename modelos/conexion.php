<?php 
    class Conexion{
        static public function conectar(){
            $link = new PDO("mysql:host=localhost;port=3330;dbname=4b-mfma-aws-wedding", "soporte4b-mfma", "soporte4b-mfma");
    
            $link->exec("set names utf8");
    
            return $link;
        }
    }
    
