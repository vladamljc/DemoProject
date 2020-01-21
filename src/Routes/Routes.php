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

            $piecesRequest = explode('/', $request->getUri());
            $piecesCurrentRoute = explode('/', $currentRoute->getUri());

            $lengthRequestRoute = count($piecesRequest);
            $lengthCurrentRoute = count($piecesCurrentRoute);

            $cntExactMatches = 0;
            if ($lengthCurrentRoute === $lengthRequestRoute) {
                for ($i = 0; $i < $lengthCurrentRoute; $i++) {
                    if ($piecesCurrentRoute[$i] === $piecesRequest[$i]) {
                        $cntExactMatches++;
                    } else {
                        $paramCurrentRoute = str_split($piecesCurrentRoute[$i]);
                        $paramCurrentRouteString = implode('', $paramCurrentRoute);

                        $paramRequestRoute = str_split($piecesRequest[$i]);
                        $paramRequestRouteString = implode('', $paramRequestRoute);

                        if ((strpos($paramCurrentRouteString,
                                    '{') === 0 && $paramCurrentRouteString[strlen($paramCurrentRouteString) - 1] === '}') || (strpos($paramCurrentRouteString,
                                    '[') === 0 && $paramCurrentRouteString[strlen($paramCurrentRouteString) - 1] === ']')) {
                            $request->addParameter($paramRequestRouteString);
                            $cntExactMatches++;
                        } else {
                            break;
                        }
                    }
                }
                if ($cntExactMatches === $lengthCurrentRoute && ($currentRoute->getMethod() === $request->getMethod())) {
                    return $currentRoute;
                }
            }
        }
        throw new RouteNotFoundException('RouteNotFoundException: route does not exist...');
    }

    /**
     * Method that returns string between two other strings that surround it.
     *
     * @param $string
     * @param $start
     * @param $end
     *
     * @return false|string
     */
    public static function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini === 0) {
            return '';
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }

}