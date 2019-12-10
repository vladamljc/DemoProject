<?php

namespace Catalog\Services;

use Catalog\Controllers\ErrorHandler;
use Catalog\Exceptions\RouteNotFoundException;
use Catalog\Http\Request;
use Catalog\Http\Response;
use Catalog\Middleware\MiddlewarePipeline;
use Catalog\Routes\Routes;

/**
 * Class Dispatcher
 *
 * @package Catalog\Services
 */
class Dispatcher
{
    /**
     * Dispatcher constructor.
     */
    public function __construct()
    {
        //echo 'Dispatcher constructed<br>';
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function dispatch(Request $request): Response
    {
        try {
            $route = Routes::getRoute($request);
        } catch (RouteNotFoundException $routeException) {
            $errorController = new ErrorHandler();
            $errorController->handleError(404);
        }

        MiddlewarePipeline::process($request, $route->getMiddlewareList());
        $controllerName = $route->getController();
        $controller = new $controllerName;
        $action = $route->getAction();

        return $controller->$action($request);
    }
}