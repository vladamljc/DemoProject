<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\Models\Admin;
use Catalog\Database\Database;

/**
 * Class AdminRepository
 *
 * @package Catalog\Data\Repositories
 */
class AdminRepository
{

    /**
     * Method that is used to check if admin with given parameters exists in database
     *
     * @param string $username
     * @param string $password
     *
     * @return Admin|null
     */
    public static function getByUsername(string $username): ?Admin
    {

        $matchThese = ['username' => $username];

        Database::getConnection();

        $admin = Admin::where($matchThese)->first();

        if ($admin === null) {
            return null;
        } else {
            return $admin;
        }
    }

}