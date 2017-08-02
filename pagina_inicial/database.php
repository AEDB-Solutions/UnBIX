<?php
class Database
{
    private static $dbName = 'UnBix_database' ;
    private static $dbHost = '127.0.0.1' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'bgt2k4m3';


    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName.";charset=utf8", self::$dbUsername, self::$dbUserPassword);
          self::$cont->exec("set names utf8");
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
