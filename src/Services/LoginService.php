<?php

namespace Catalog\Services;

use Catalog\Data\Models\Admin;
use Catalog\Data\Repositories\AdminRepository;
use Catalog\Utility\CookieManagement;
use Catalog\Utility\Session;

/**
 * Class LoginService
 *
 * @package Catalog\Services
 */
class LoginService
{

    /**
     * Checking if user exists in database
     *
     * @param string $username
     * @param string $password
     * @param bool $stayLoggedIn
     *
     * @return bool
     */
    public static function login(string $username, string $password, bool $stayLoggedIn): bool
    {
        /**
         * @var Admin $admin
         */
        $admin = AdminRepository::getByUsername($username);

        if ($admin === null) {
            return false;
        }

        $passwordHashedDB = $admin->Password;

        $passwordHashed = hash('sha256', $password);

        if (!hash_equals($passwordHashed, $passwordHashedDB)) {
            return false;
        }

        Session::setParameter('username', $username);
        Session::setParameter('password', $password);

        $cookieName = 'cookieAdmin';
        if ($stayLoggedIn === true) {
            CookieManagement::setCookie($username, $passwordHashed, $cookieName);
        } else {
            CookieManagement::removeCookie($cookieName);
        }

        return true;
    }

}