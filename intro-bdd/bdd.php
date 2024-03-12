<?php
class Database
{
    private static $dbHost = 'localhost';
    private static $dbName = 'maBddTest';
    private static $dbUser = 'root';
    private static $dbPass = 'root';

    private static $connection = null;

    public static function connect()
{
    if (null === self::$connection) {
        try {
            self::$connection = new PDO(
                'mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName . ';charset=utf8',
                self::$dbUser,
                self::$dbPass,  
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)  // Enable error handling
            );
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
        return self::$connection;
    }
}


    public static function disconnect()
    {
        self::$connection = null;
    }
}

//$db = new Database(); // Instance
//$db = Database::connect(); // Connection via méthodes static 