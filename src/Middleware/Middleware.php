<?php

namespace Catalog\Middleware;

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
     */
    abstract public function handle(Request $request): void;
}