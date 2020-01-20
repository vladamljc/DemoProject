<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\Models\Statistics;

/**
 * Class StatisticsRepository
 *
 * @package Catalog\Data\Repositories
 */
class StatisticsRepository
{

    /**
     * Returns how many times have users clicked on site.
     *
     * @return Statistics
     */
    public static function getHomepageOpeningCount(): Statistics
    {
        return Statistics::where('Id', 1)->first();
    }

    /**
     * Increments number of visits for homepage.
     */
    public static function incrementHomepageCount(): void
    {
        Statistics::where('Id', 1)->increment('HomeViewCount');
    }
}