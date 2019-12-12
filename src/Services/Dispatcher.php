<?php

namespace Catalog\Services;

use Catalog\Controllers\ErrorHandler;
use Catalog\Exceptions\MiddlewarePassFailed;
use Catalog\Exceptions\RouteNotFoundException;
use Catalog\Http\ExceptionResponse;
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
     * @param Request $request
     *
     * @return Response
     * @throws MiddlewarePassFailed
     */
    public function dispatch(Request $request): Response
    {
        try {
            $route = Routes::getRoute($request);
        } catch (RouteNotFoundException $routeException) {
            $errorController = new ErrorHandler();
            $errorController->handleError(404);

            return new ExceptionResponse(404);
        }

        try {
            MiddlewarePipeline::process($request, $route->getMiddlewareList());
        } catch (MiddlewarePassFailed $middlewarePassFailed) {
            $errorController = new ErrorHandler();
            $errorController->handleError(401);

            return new ExceptionResponse(401);
        }

        $controllerName = $route->getController();
        $controller = new $controllerName;
        $action = $route->getAction();

        return $controller->$action($request);
    }
}