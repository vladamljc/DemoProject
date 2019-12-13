<?php

namespace Catalog\Services;

use Catalog\Data\Models\Admin;
use Catalog\Data\Repositories\AdminRepository;
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
     * @param bool $check
     *
     * @return bool
     */
    public static function login(string $username, string $password, bool $check): bool
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

        if ($passwordHashed !== $passwordHashedDB) {
            return false;
        }

        Session::startSession();
        Session::setParameter('username', $username);
        Session::setParameter('password', $password);

        if ($check === true) {
            $cookieName = 'cookieAdmin';
            setcookie($cookieName, $username, time() + 60 * 60 * 24 * 365, '/');
        } else {
            $cookieName = 'cookieAdmin';
            setcookie($cookieName, '', time() - 3600);
        }

        return true;
    }

}