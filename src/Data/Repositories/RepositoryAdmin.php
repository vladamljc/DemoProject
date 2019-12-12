<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\Models\Admin;
use Catalog\Database\Database;
use Illuminate\Database\Eloquent\Collection;

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
     * @return Admin|null
     */
    public static function getAdmin(string $username, string $password): ?Admin
    {
        $encrypted_password = hash('sha256', $password);
        $matchThese = ['username' => $username, 'password' => $encrypted_password];

        Database::getConnection();

        /** @var Collection $admins */
        $admins = Admin::where($matchThese)->get();

        if ($admins->isEmpty()) {
            return null;
        } else {
            return $admins[0];
        }
    }

}