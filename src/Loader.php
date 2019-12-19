<?php

namespace Catalog;

use Catalog\Database\Database;
use Catalog\Utility\Session;

/**
 * Class Loader
 */
class Loader
{

    /**
     *Loading all valid routes
     */
    public function load(): void
    {
        Database::connect();
        Session::startSession();
        $relativeRoute = LOAD_ROUTES_FROM;
        $routesDirectory = __DIR__ . '/../' . trim($relativeRoute, '/') . '/';

        foreach (glob($routesDirectory . '*.php') as $filename) {
            require_once $filename;
        }
    }
}