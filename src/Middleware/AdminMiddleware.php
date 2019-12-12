<?php

namespace Catalog\Middleware;

use Catalog\Exceptions\MiddlewarePassFailed;
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
     *
     * @throws MiddlewarePassFailed
     */
    public function handle(Request $request): void
    {
        session_start();

        if (!isset($_COOKIE['cookieAdmin'])) {
            if (!isset($_SESSION['username'], $_SESSION['password'])) {
                throw new MiddlewarePassFailed('USER ACTION NOT AUTHORIZED!');
            }
        }
    }
}