
<?php
class DB
{
    private static $host = DB_HOST;
    private static $user = DB_USER;
    private static $pass = DB_PASS;
    private static $dbname = DB_NAME;
    private static $instance = NULl;
    public static function getInstance() {
        if (!isset(self::$instance)) {
            try {
                $dsn = 'mysql:host='.self::$host.';dbname='.self::$dbname;
                self::$instance = new PDO($dsn, self::$user, self::$pass);
                self::$instance->exec("SET NAMES 'utf8'");
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        return self::$instance;
    }
}