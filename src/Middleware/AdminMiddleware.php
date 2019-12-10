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
     * Tries to handle request passed as argument
     *
     * @param Request $request
     */
    public function handle(Request $request): void
    {

    }
}