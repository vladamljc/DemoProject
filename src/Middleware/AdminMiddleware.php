<?php

namespace Catalog\Middleware;

use Catalog\Exceptions\MiddlewarePassFailed;
use Catalog\Http\Request;
use Catalog\Utility\Session;

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

        Session::startSession();
        if (!isset($_COOKIE['cookieAdmin'])) {
            if (Session::isSessionActive() === false) {
                throw new MiddlewarePassFailed('USER ACTION NOT AUTHORIZED!');
            }
        }
    }
}