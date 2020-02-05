<?php

namespace Catalog\Services;

use Catalog\Data\DTO\Product;
use Catalog\Data\Repositories\ProductRepository;
use Catalog\Utility\ParameterSearch;

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

        $productDTO = new Product($product->CategoryId, $product->SKU, $product->Title, $product->Brand,
            $product->Price, $product->ShortDescription, $product->Description, $product->Image, $product->Enabled,
            $product->Featured, $product->ViewCount);
        $productDTO->setId($product->Id);

        return $productDTO;
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

    /**
     * @param Product $product
     */
    public static function editProduct(Product $product): void
    {
        ProductRepository::editProduct($product);
    }

    /**
     * Returns all featured products from database.
     *
     * @return array
     */
    public static function getFeaturedProducts(): array
    {
        $productsDTO = array();
        $productModels = ProductRepository::getFeaturedProducts();
        foreach ($productModels as $model) {
            $productDTO = new Product($model->CategoryId, $model->SKU, $model->Title, $model->Brand, $model->Price,
                $model->ShortDescription, $model->Description, $model->Image, $model->Enabled, $model->Featured,
                $model->ViewCount);
            $productsDTO[] = $productDTO;
        }

        return $productsDTO;
    }

    /**
     * Returns all products by given category.
     *
     * @param string $categoryCode
     *
     * @return array
     */
    public static function getProductsByCategoryCode(string $categoryCode): array
    {
        $productModels = ProductRepository::getProductsByCategoryCode($categoryCode);
        $productsDTO = array();

        foreach ($productModels as $model) {
            $productDTO = new Product($model->CategoryId, $model->SKU, $model->Title, $model->Brand, $model->Price,
                $model->ShortDescription, $model->Description, $model->Image, $model->Enabled, $model->Featured,
                $model->ViewCount);
            $productsDTO[] = $productDTO;
        }

        return $productsDTO;
    }

    /**
     * Method that returns filtered products for category that has subcategories.
     *
     * @param array $ids
     * @param string $column
     * @param string $method
     * @param int $productsPerPage
     * @param int $offset
     *
     * @return array
     */
    public static function getProductsByIds(
        array $ids,
        string $column,
        string $method,
        int $productsPerPage,
        int $offset
    ): ?array {
        $sortDirection = $method === 'ascending' ? 'asc' : 'desc';

        $productModels = ProductRepository::getProductsByIds($ids, $column, $sortDirection, $productsPerPage, $offset);
        $products = array();

        foreach ($productModels as $model) {
            $productDTO = new Product($model->CategoryId, $model->SKU, $model->Title, $model->Brand, $model->Price,
                $model->ShortDescription, $model->Description, $model->Image, $model->Enabled, $model->Featured,
                $model->ViewCount);
            $products[] = $productDTO;
        }

        return $products;
    }

    /**
     * Method that returns filtered products for category that does not have subcategories.
     *
     * @param int $id
     * @param string $column
     * @param string $method
     * @param int $productsPerPage
     * @param int $offset
     *
     * @return array|null
     */
    public static function getProductsById(
        int $id,
        string $column,
        string $method,
        int $productsPerPage,
        int $offset
    ): ?array {
        $sortDirection = $method === 'ascending' ? 'asc' : 'desc';
        $productModels = ProductRepository::getProductsById($id, $column, $sortDirection, $productsPerPage, $offset);
        $products = array();

        foreach ($productModels as $model) {
            $productDTO = new Product($model->CategoryId, $model->SKU, $model->Title, $model->Brand, $model->Price,
                $model->ShortDescription, $model->Description, $model->Image, $model->Enabled, $model->Featured,
                $model->ViewCount);
            $products[] = $productDTO;
        }

        return $products;
    }

    /**
     * Returns number of products that belong to passed array of ids.
     *
     * @param array $ids
     * @param string $column
     * @param string $method
     *
     * @return int
     */
    public static function getProductsNumberByIds(array $ids, string $column, string $method): int
    {
        $sortDirection = $method === 'ascending' ? 'asc' : 'desc';

        return ProductRepository::getProductsNumberByIds($ids, $column, $sortDirection);
    }

    /**
     * Returns number of products that belong to category by id.
     *
     * @param int $id
     * @param string $column
     * @param string $method
     *
     * @return int
     */
    public static function getProductsNumberById(int $id, string $column, string $method): int
    {
        $sortDirection = $method === 'ascending' ? 'asc' : 'desc';

        return ProductRepository::getProductsNumberById($id, $column, $sortDirection);
    }

    /**
     * Method used to search database for products required by criteria.
     *
     * @param ParameterSearch $searchParam
     *
     * @return array
     */
    public static function searchProducts(
        $searchParam
    ): array {

        if ($searchParam->categoryInfo['code'] !== 'any') {
            $id = CategoryService::getCategoryByCode($searchParam->categoryInfo['code'])->getId();
            $children = CategoryService::getChildrenIds($id);
            $children[] = $id;
            $searchParam->categoryInfo = $children;
        } else {
            $searchParam->categoryInfo = array();
        }

        return $searchParam->searchType === 'relevance' ? self::searchRelevance($searchParam) : array();
    }

    /**
     * Returns number of products that match search criteria.
     *
     * @param ParameterSearch $searchParam
     *
     * @return int
     */
    public static function countNumberProducts(ParameterSearch $searchParam): int
    {
        if ($searchParam->categoryInfo['code'] !== 'any') {
            $id = CategoryService::getCategoryByCode($searchParam->categoryInfo['code'])->getId();
            $children = CategoryService::getChildrenIds($id);
            $searchParam->categoryInfo = $children;
        } else {
            $searchParam->categoryInfo = array();
        }

        return ProductRepository::countNumberProducts($searchParam);
    }

    /**
     * Does search by defined relevance. First titles are searched etc.
     *
     * @param ParameterSearch $searchParam
     *
     * @return array
     */
    public static function searchRelevance(ParameterSearch $searchParam): array
    {
        $productDTOs = array();
        $productsModels = ProductRepository::searchProducts($searchParam);
        foreach ($productsModels as $productModel) {
            $productDTO = new Product($productModel->CategoryId, $productModel->SKU, $productModel->Title,
                $productModel->Brand, $productModel->Price,
                $productModel->ShortDescription, $productModel->Description, $productModel->Image,
                $productModel->Enabled, $productModel->Featured,
                $productModel->ViewCount);
            $productDTOs[] = $productDTO;
        }

        return $productDTOs;
    }

    /**
     *Increment view count for product passed as argument.
     *
     * @param Product $product
     */
    public static function incrementViewCount(Product $product): void
    {
        ProductRepository::incrementViewCount($product);
    }

}