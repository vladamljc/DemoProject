<?php

namespace Catalog\Services;

use Catalog\Data\Models\Admin;
use Catalog\Data\Repositories\RepositoryAdmin;

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
     * @return Admin
     */
    public static function login(string $username, string $password): Admin
    {
        /**
         * @var Admin $admin
         */
        $admin = RepositoryAdmin::getAdmin($username, $password);

        if ($admin === null) {
            return null;
        }

        return $admin;
    }

}