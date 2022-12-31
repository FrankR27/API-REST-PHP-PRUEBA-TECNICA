<?php

namespace App\Database;

use App\Config\ResponseHttp;
use PDO;

require __DIR__ . '/dataDataBase.php';

class ConnectionDataBase
{

    private static $host = '';
    private static $user = '';
    private static $password = '';

    final public static function connect($host, $user, $password)
    {
        self::$host     = $host;
        self::$user     = $user;
        self::$password = $password;
    }

    // Conexión a la base de datos
    final public static function getConnection()
    {
        try {
            $opt = [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC];
            $dsn = new PDO(self::$host, self::$user, self::$password, $opt);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log('Conexión exitosa a la base de datos');
            return $dsn;
        } catch (\PDOException $p) {
            error_log('Error en la conexión a la base de datos: ' . $p->getMessage());
            die(json_encode(ResponseHttp::status500()));
        }
    }
}
