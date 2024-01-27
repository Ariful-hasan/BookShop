<?php

namespace Src\Utils;

use mysqli;

Class Database
{
    protected static $connection = false;

    private function __construct()
    {
          
    }

    public static function dbConnect(): mysqli
    {
        if (!static::$connection) {
            try {
                static::$connection = mysqli_connect(DB_HOST, DB_USER, '', DB_NAME);
            } catch (\mysqli_sql_exception $e) {
                throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
            }  
        }
         
        return static::$connection;
    }

    public static function dbClose(): void
    {
        if (static::$connection) {
            mysqli_close(static::$connection);
        }
    }
}