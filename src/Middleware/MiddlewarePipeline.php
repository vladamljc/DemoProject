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
     * MiddlewarePipeline constructor.
     */
    protected function __construct()
    {

    }

    /**
     * @param Request $request
     * @param array $listMiddlewareNames
     */
    public static function process(Request $request, array $listMiddlewareNames): void
    {
        foreach ($listMiddlewareNames as $middlewareName) {
            $middleware = new $middlewareName;
            echo "Middleware {$middlewareName} constructed";
            $middleware->handle($request);
            echo "Middleware {$middlewareName} handle method called";
        }
    }

}