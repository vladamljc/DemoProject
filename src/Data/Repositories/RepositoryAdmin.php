<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\Models\Admin;
use Catalog\Database\Database;

/**
 * Class RepositoryAdmin
 *
 * @package Catalog\Data\Repositories
 */
class RepositoryAdmin
{

    /**
     * Method that is used to check if admin with given parameters exists in database
     *
     * @param string $username
     * @param string $password
     *
     * @return Admin
     */
    public static function getAdmin(string $username, string $password): Admin
    {
        $encrypted_password = hash('sha256', $password);
        $matchThese = ['username' => $username, 'password' => $encrypted_password];

        Database::getConnection();

        $admins = Admin::where($matchThese)->get();

        return $admins[0];
    }

}