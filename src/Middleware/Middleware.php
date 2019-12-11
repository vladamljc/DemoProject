<?php

namespace Catalog\Middleware;

use Catalog\Exceptions\MiddlewarePassFailed;
use Catalog\Http\Request;

/**
 * Class Middleware
 *
 * @package Catalog\Middleware
 */
abstract class Middleware
{

    /**
     * Tries to handle request passed as argument.
     *
     * @param Request $request
     *
     * @throws MiddlewarePassFailed exception if middleware fails to handle given request
     */
    abstract public function handle(Request $request): void;
}