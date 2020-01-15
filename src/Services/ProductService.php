<?php

namespace Catalog\Services;

use Catalog\Data\DTO\Product;
use Catalog\Data\Repositories\ProductRepository;

/**
 * Class ProductService
 *
 * @package Catalog\Services
 */
class ProductService
{
    /**
     * @param Product $newProduct
     */
    public static function addNewProduct(Product $newProduct): void
    {
        ProductRepository::addNewProduct($newProduct);
    }

    /**
     * @param $SKU
     *
     * @return Product|null
     */
    public static function getProductBySKU($SKU): ?Product
    {
        $product = ProductRepository::getProductBySKU($SKU);

        return new Product($product->CategoryId, $product->SKU, $product->Title, $product->Brand,
            $product->Price, $product->ShortDescription, $product->Description, $product->Image, $product->Enabled,
            $product->Featured, $product->ViewCount);
    }

    /**
     * @param $SKU
     * @param $imagePath
     */
    public static function updateProductImageBySKU($SKU, $imagePath): void
    {
        ProductRepository::updateProductImageBySKU($SKU, $imagePath);
    }

    /**
     * /**
     * @param int $offset
     *
     * @return array|null
     */
    public static function getPage(int $offset): ?array
    {
        $listOfProducts = ProductRepository::getPage($offset);
        $listOfProductsDTO = array();
        foreach ($listOfProducts as $product) {
            $productDTO = new Product($product->CategoryId, $product->SKU, $product->Title, $product->Brand,
                $product->Price, $product->ShortDescription, $product->Description, $product->Image, $product->Enabled,
                $product->Featured, $product->ViewCount);

            $productCategory = CategoryService::getCategoryById($product->CategoryId);
            $productDTO->setCategoryName($productCategory->getTitle());

            $listOfProductsDTO[] = $productDTO;
        }

        return $listOfProductsDTO;
    }

    /**
     * Returns number of products from database.
     *
     * @return int
     */
    public static function getNumberOfProducts(): int
    {
        return ProductRepository::getNumberOfProducts();
    }

    /**
     * Method to enable product.
     *
     * @param array $productsToEnable
     */
    public static function enableSelectedProducts(array $productsToEnable): void
    {
        ProductRepository::enableSelectedProducts($productsToEnable);
    }

    /**
     * Method to disable product.
     *
     * @param array $productsToDisable
     */
    public static function disableSelectedProducts(array $productsToDisable): void
    {
        ProductRepository::disableSelectedProducts($productsToDisable);
    }

    /**
     * Method to delete selected products.
     *
     * @param array $productsToDelete
     */
    public static function deleteSelectedProducts(array $productsToDelete): void
    {
        ProductRepository::deleteSelectedProducts($productsToDelete);
    }

    /**
     * Method to delete single product
     *
     * @param Product $product
     */
    public static function deleteProduct(Product $product): void
    {
        ProductRepository::deleteProduct($product);
    }

}