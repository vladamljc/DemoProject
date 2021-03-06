<?php

namespace Catalog\Data\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 *
 * @package Catalog\Data\Models
 * @property int Id
 * @property int ParentId
 * @property int Code
 * @property string Title
 * @property string Description
 * @method static Builder where(string $string, int $param)
 * @method static self find(int $Id)
 */
class Category extends Model
{
    protected $table = 'category';

    public $timestamps = false;

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'ParentId', 'Id');
    }

}