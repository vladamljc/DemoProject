<?php

namespace Catalog\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class Database
 *
 * @package Catalog\Database
 */
class Database
{
    /**
     * @var Capsule to access database
     */
    protected static $capsule;

    /**
     * Database constructor
     */
    protected function __construct()
    {
    }

    /**
     * Retrieves database connection.
     *
     * @return Capsule
     */
    public static function getConnection(): Capsule
    {
        if (self::$capsule === null) {
            self::$capsule = self::getCapsuleInstance();
        }

        return self::$capsule;
    }

    /**
     * Function retrieve an instance of Capsule.
     *
     * @return Capsule
     */
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