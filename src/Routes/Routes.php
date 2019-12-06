<?php

namespace Catalog\Routes;

use Catalog\Exceptions\RouteNotFoundException;
use Catalog\Http\Request;

/**
 * Class Routes
 *
 * @package Catalog\Routes
 */
class Routes
{
    /**
     * @var array
     */
    private static $registeredRoutes = array();

    /**
     * Routes constructor.
     */
    protected function __construct()
    {

    }

    /**
     * @param Route $route
     */
    public static function add(Route $route): void
    {
        self::$registeredRoutes[] = $route;
        //echo 'route added <br>';
    }

    /**
     * @param Request $request
     *
     * @return Route
     * @throws RouteNotFoundException
     */
    public static function getRoute(Request $request): Route
    {
        //echo 'method Routes::getRoute() called<br>';
        foreach (self::$registeredRoutes as $current_route) {
            if (($current_route->getMethod() === $request->getMethod()) && ($current_route->getUri() === $request->getUri())) {
                //echo 'Route found...<br>';
                return $current_route;
            }
        }
        //echo 'route not found...<br>';
        throw new RouteNotFoundException('RouteNotFoundException: route does not exist...');
    }

}