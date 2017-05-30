<?php
class Database
{
    private static $dbName = 'UnBix_database' ;
    private static $dbHost = '127.0.0.1' ;
    private static $dbUsername = 'root';
<<<<<<< HEAD
    private static $dbUserPassword = 'Jesuscristo3';

=======
    private static $dbUserPassword = 'aSSiral';
     
>>>>>>> e945adbdd644d0fe8eb760aafca808d6be3f1c53
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
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
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
