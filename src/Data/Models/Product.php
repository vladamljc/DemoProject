<?php

namespace Catalog\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Product
 *
 * @package Catalog\Data\Models
 * @property int Id
 * @property int CategoryId
 * @property string SKU
 * @property string Title
 * @property string Brand
 * @property double Price
 * @property string ShortDescription
 * @property string Description
 * @property string Image
 * @property int Enabled
 * @property int Featured
 * @property int ViewCount
 */
class Product extends Model
{
    public $timestamps = false;
    protected $table = 'product';

    public function category(): HasOne
    {
        return $this->belongsTo('Catalog\Data\Models\Category');
    }

}