<?php

class MonPDO {
    private const HOST_NAME = "localhost";
    private const DB_NAME = "animaux";
    private const USER_NAME = "root";
    private const PWD = "";

    private static $monPDOinstance = null;

    public static function getPDO(){
        if(is_null(self::$monPDOinstance)){
            try{
                self::$monPDOinstance = new PDO("mysql:host=".self::HOST_NAME.";dbname=".self::DB_NAME,self::USER_NAME,self::PWD);

            } catch(PDOException $e){
                $message = "Erreur de connexion à la BD". $e->getMessage();
                die($message);
            }
        }
        return self::$monPDOinstance;
    }
   
}