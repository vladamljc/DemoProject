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
     * @param Route $route
     */
    public static function add(Route $route): void
    {
        self::$registeredRoutes[] = $route;
    }

    /**
     * @param Request $request
     *
     * @return Route
     * @throws RouteNotFoundException
     */
    public static function getRoute(Request $request): Route
    {
        foreach (self::$registeredRoutes as $currentRoute) {
            if (($currentRoute->getMethod() === $request->getMethod()) && ($currentRoute->getUri() === $request->getUri())) {
                return $currentRoute;
            }
        }
        throw new RouteNotFoundException('RouteNotFoundException: route does not exist...');
    }

}