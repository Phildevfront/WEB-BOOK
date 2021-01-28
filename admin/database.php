<?php

class Database
{

    private static $dbHost = "localhost"; //mask.o2switch.net
    private static $dbName = "portfolio"; //baph4737_portfolio
    private static $dbUser = "root"; // baph4737
    private static $dbUserPassword = "root"; // RMRvNgmAVYNv
    
    private static $connection = null;

    public static function connect()
    {

        try
        {
            self::$connection = new PDO("mysql:host=" . self::$dbHost .  ";dbname=" . 
            self::$dbName,self::$dbUser,self::$dbUserPassword);   
        }
        catch(PDOException $e) 
        {
            die($e->getMessage()); 
        }
        return  self::$connection;

    }

    public static function disconnect()
    {
        self::$connection = null;
    }

}

?>