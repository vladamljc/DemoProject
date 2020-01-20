<?php

namespace Catalog\Services;

use Catalog\Data\DTO\Product;
use Catalog\Data\DTO\Statistics;
use Catalog\Data\Repositories\ProductRepository;
use Catalog\Data\Repositories\StatisticsRepository;

/**
 * Class StatisticsService
 *
 * @package Catalog\Services
 */
class StatisticsService
{

    /**
     * Returns number of products.
     *
     * @return int
     */
    public static function getProductsCount(): int
    {
        return ProductService::getNumberOfProducts();
    }

    /**
     * Returns number of categories.
     *
     * @return int
     */
    public static function getCategoriesCount(): int
    {
        return CategoryService::getNumberOfCategories();
    }

    /**
     * Returns how many times have users clicked on site.
     *
     * @return int
     */
    public static function getHomeViewCount(): int
    {
        $statisticsModel = StatisticsRepository::getHomepageOpeningCount();
        $statisticsDTO = new Statistics($statisticsModel->Id, $statisticsModel->HomeViewCount);

        return $statisticsDTO->getHomeViewCount();
    }

    /**
     * Returns most viewed product.
     *
     * @return Product
     */
    public static function getMostViewedProduct(): Product
    {
        $productModel = ProductRepository::getMostViewedProduct();

        return new Product($productModel->CategoryId, $productModel->SKU, $productModel->Title, $productModel->Brand,
            $productModel->Price, $productModel->ShortDescription, $productModel->Description, $productModel->Image,
            $productModel->Enabled, $productModel->Featured, $productModel->ViewCount);
    }

    /**
     * Increments homepage view number.
     */
    public static function incrementHomepageCount(): void
    {
        StatisticsRepository::incrementHomepageCount();
    }

}