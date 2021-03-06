<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\Models\Admin;
use Illuminate\Support\Collection;

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
     *
     * @return Admin|null
     */
    public static function getByUsername(string $username): ?Admin
    {
        return Admin::query()->where('username', $username)->first();
    }

    /**
     * Returns all admins from database.
     *
     * @return Collection
     */
    public static function getAdmins(): Collection
    {
        return Admin::all();
    }

}