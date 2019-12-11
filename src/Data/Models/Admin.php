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
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class Admin extends Model
{
    protected $table = 'admin';
}