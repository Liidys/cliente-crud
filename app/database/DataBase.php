<?php

namespace App\Database;

use PDO;

class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (!self::$connection) {
            self::$connection = new PDO('mysql:host=localhost;dbname=crud_cliente', 'root', '');
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }

        return self::$connection;
        
    }
}
