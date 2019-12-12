<?php

namespace Catalog\Services;

use Catalog\Data\Models\Admin;
use Catalog\Data\Repositories\AdminRepository;

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
     *
     * @return Admin|null
     */
    public static function login(string $username, string $password): ?Admin
    {
        /**
         * @var Admin $admin
         */
        $admin = AdminRepository::getByUsername($username, $password);

        if ($admin === null) {
            return null;
        } else {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            if (isset($_POST['checkboxLoggedIn'])) {
                $cookieName = 'cookieAdmin';
                setcookie($cookieName, $username);
            }

            return $admin;
        }
    }

}