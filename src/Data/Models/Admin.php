<?php

namespace Catalog\Data\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 *
 * @package Catalog\Data\Models
 * @property int Id
 * @property string Username
 * @property string Password
 * @method where
 * @method create
 * @method update
 */
class Admin extends Model
{
    protected $table = 'admin';
}