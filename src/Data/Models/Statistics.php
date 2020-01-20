<?php

namespace Catalog\Data\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StatisticsService
 *
 * @package Catalog\Data\Models
 * @property int Id
 * @property int HomeViewCount
 * @method static Builder where(string $string, int $param)
 * @method static self find(int $Id)
 */
class Statistics extends Model
{
    public $timestamps = false;
    protected $table = 'statistics';
}