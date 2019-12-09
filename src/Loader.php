<?php

namespace Catalog;

/**
 * Class Loader
 */
class Loader
{
    /**
     * Loader constructor.
     */
    public function __construct()
    {
        //echo 'Loader constructed<br>';
    }

    /**
     *
     */
    public function load(): void
    {
        $relativeRoute = LOAD_ROUTES_FROM;
        $routesDirectory = __DIR__ . '/../' . trim($relativeRoute, '/') . '/';

        foreach (glob($routesDirectory . '*.php') as $filename) {
            require_once $filename;
        }
    }
}