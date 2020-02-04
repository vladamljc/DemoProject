<?php

namespace Catalog\Data\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RelevanceView
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
 * @property string CategoryTitle
 */
class RelevanceView extends Model
{
    public $timestamps = false;
    protected $table = 'relevanceview';
}