<?php

namespace Catalog;

use Catalog\Database\Database;

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
        Database::getConnection();

        $relativeRoute = LOAD_ROUTES_FROM;
        $routesDirectory = __DIR__ . '/../' . trim($relativeRoute, '/') . '/';

        foreach (glob($routesDirectory . '*.php') as $filename) {
            require_once $filename;
        }
    }
}