<?php
class conexion{
    public function conectar(){
        try{
            $conn = new PDO ("mysql:host=localhost;dbname=RojasSantana;", "root", "");
            //echo("correcto");
            return $conn;
        }catch(PDOException $e){
            echo "Fallo", $e->getMessage();
            return null;
        }
    }
}