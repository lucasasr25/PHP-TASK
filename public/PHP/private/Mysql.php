<?php
include_once('config.php');
class Mysql{
    private static $pdo;
    public static function connect(){
        try{
            // creating a PDO instance with the defined parameters
            self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){echo '<h6>SQL CONNECTION ERROR<h6>'; echo $e;}
        return self::$pdo;
    }
}
?>
