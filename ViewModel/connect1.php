<?php
class Connection
{

    static $host = 'localhost';
    static $user = 'user-data';
    static $pw = '12345678';
    static $database = 'users';

    public static function dbConnect()
    {
        $db = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$database . '', self::$user, self::$pw) or die("Cannot connect to mySQL.");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

}
// $connectionInstance = new Connection();
// $connec = $connectionInstance->dbConnection();

?>
