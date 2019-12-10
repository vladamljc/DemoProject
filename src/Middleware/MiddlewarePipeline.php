<?php

namespace Catalog\Middleware;

use Catalog\Http\Request;

/**
 * Class MiddlewarePipeline
 *
 * @package Catalog\Middleware
 */
class MiddlewarePipeline
{

    /**
     * Checks if request can pass trough the list of middlewares.
     *
     * @param Request $request
     * @param array $listMiddlewareNames
     */
    public static function process(Request $request, array $listMiddlewareNames): void
    {
        foreach ($listMiddlewareNames as $middlewareName) {
            /** @var Middleware $middleware */
            $middleware = new $middlewareName;
            $middleware->handle($request);
        }
    }

}