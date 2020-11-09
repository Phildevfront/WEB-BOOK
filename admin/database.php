<?php

class Database
{

    private static $dbHost = "localhost";
    private static $dbName = "portfolio";
    private static $dbUser = "root";
    private static $dbUserPassword = "root";
    
    private static $connection = null;

    public static function connect()
    {

        try
        {
            self::$connection = new PDO("mysql:host=" . self::$dbHost .  ";dbname=" . 
            self::$dbName,self::$dbUser,self::$dbUserPassword);  /* connection a la DB avc PDO*/ 
        }
        catch(PDOException $e) 
        {
            die($e->getMessage()); /* Affiche message erreur*/
        }
        return  self::$connection;

    }

    public static function disconnect()
    {
        self::$connection = null;
    }

}

?>