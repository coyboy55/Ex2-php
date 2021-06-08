<?php
class ClassConnection
{

    static $host = 'localhost';
    static $user = 'user-data';
    static $pw = '12345678';
    static $database = 'users';

    public static function db_connect()
    {
        $db = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$database . '', self::$user, self::$pw) or die("Cannot connect to mySQL.");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

}
?>