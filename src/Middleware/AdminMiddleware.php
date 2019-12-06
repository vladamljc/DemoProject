<?php

namespace Catalog\Middleware;

use Catalog\Http\Request;

/**
 * Class AdminMiddleware
 *
 * @package Catalog\Middleware
 */
class AdminMiddleware extends Middleware
{

    /**
     * @param Request $request
     */
    public function handle(Request $request): void
    {
        echo 'Dummy middleware handle called';
        //throws Exceptions...
    }
}