<?php

namespace Catalog\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    protected static $capsule;

    protected function __construct()
    {
    }

    public static function getConnection(): Capsule
    {
        if (self::$capsule === null) {
            self::$capsule = self::getCapsuleInstance();
        }

        return self::$capsule;
    }

    protected static function getCapsuleInstance(): Capsule
    {
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => DB_DRIVER,
            'host' => DB_HOST,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS,
            'port' => DB_PORT,
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    }

}