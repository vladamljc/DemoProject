<?php

namespace Catalog\Middleware;

use Catalog\Data\Repositories\AdminRepository;
use Catalog\Exceptions\MiddlewarePassFailed;
use Catalog\Http\Request;
use Catalog\Utility\CookieManagement;
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
        if (!isset($_COOKIE['cookieAdmin'])) {
            if (!Session::areSessionParametersSet()) {
                throw new MiddlewarePassFailed('USER ACTION NOT AUTHORIZED!');
            }
        } else {
            $hashedCookieValue = CookieManagement::readCookie('cookieAdmin');
            $admins = AdminRepository::getAdmins();
            foreach ($admins as $admin) {
                $username = $admin->Username;
                $password = $admin->Password;
                $hashedAdminValue = hash('sha256', $username . '/' . $password);
                if (hash_equals($hashedCookieValue, $hashedAdminValue)) {
                    return;
                }
            }
            throw new MiddlewarePassFailed('USER ACTION NOT AUTHORIZED!');
        }
    }
}

