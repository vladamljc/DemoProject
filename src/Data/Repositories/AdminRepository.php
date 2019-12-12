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
    public static function getByUsername(string $username, string $password): ?Admin
    {

        $matchThese = ['username' => $username];

        Database::getConnection();

        $admins = Admin::where($matchThese)->first();

        if ($admins === null) {
            return null;
        } else {
            $passwordHashedDB = $admins->Password;

            $passwordHashed = hash('sha256', $password);

            if ($passwordHashed === $passwordHashedDB) {
                return $admins;
            }

            return null;
        }
    }

}