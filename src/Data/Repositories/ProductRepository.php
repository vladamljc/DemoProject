<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\DTO\Product;
use Catalog\Data\Models\Category;
use Catalog\Data\Models\Product as ProductModel;
use Catalog\Data\Models\RelevanceView;
use Catalog\Utility\ParameterSearch;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductRepository
 *
 * @package Catalog\Data\Repositories
 */
class ProductRepository
{
    /**
     * Method to add new product to database.
     *
     * @param Product $newProduct
     */
    public static function addNewProduct(Product $newProduct): void
    {
        $modelProduct = new ProductModel();
        $modelProduct->CategoryId = $newProduct->getCategoryId();
        $modelProduct->SKU = $newProduct->getSku();
        $modelProduct->Title = $newProduct->getTitle();
        $modelProduct->Brand = $newProduct->getBrand();
        $modelProduct->Price = $newProduct->getPrice();
        $modelProduct->ShortDescription = $newProduct->getShortDescription();
        $modelProduct->Description = $newProduct->getDescription();
        $modelProduct->Enabled = $newProduct->getEnabled();
        $modelProduct->Featured = $newProduct->getFeatured();
        $modelProduct->Image = $newProduct->getImage();
        $modelProduct->ViewCount = $newProduct->getViewCount();
        $modelProduct->save();
    }

    /**
     * Returns product by sku.
     *
     * @param string $sku
     *
     * @return ProductModel | null
     */
    public static function getProductBySKU(string $sku): ?ProductModel
    {
        return ProductModel::query()->where('SKU', $sku)->first();
    }

    /**
     * @param string $sku
     * @param string $imagePath
     */
    public static function updateProductImageBySKU(string $sku, string $imagePath): void
    {
        ProductModel::query()->where('SKU', $sku)->update([
            'Image' => $imagePath
        ]);
    }

    /**
     * @param int $pageOffset
     *
     * @return Collection|null
     */
    public static function getPage(int $pageOffset): ?Collection
    {

        return ProductModel::query()->offset($pageOffset * 10)->limit(10)->get();
    }

    /**
     * Returns number of products from database.
     *
     * @return int
     */
    public static function getNumberOfProducts(): int
    {
        return ProductModel::all()->count();
    }

    /**
     * Method that sets flag enabled in database table for selected products.
     *
     * @param array $productsToEnable
     */
    public static function enableSelectedProducts(array $productsToEnable): void
    {
        foreach ($productsToEnable as $product) {
            ProductModel::query()->where('SKU', $product->getSKU())->update([
                'Enabled' => 1
            ]);
        }
    }

    /**
     *  Method that disables selected products.
     *
     * @param array $productsToDisable
     */
    public static function disableSelectedProducts(array $productsToDisable): void
    {
        foreach ($productsToDisable as $product) {
            ProductModel::query()->where('SKU', $product->getSKU())->update([
                'Enabled' => 0
            ]);
        }
    }

    /**
     * Method that resets flag enable in database table for selected products.
     *
     * @param array $productsToDelete
     */
    public static function deleteSelectedProducts(array $productsToDelete): void
    {
        foreach ($productsToDelete as $product) {
            ProductModel::query()->where('SKU', $product->getSKU())->delete();
            unlink($product->getImage());
        }
    }

    /**
     * Method to delete single category
     *
     * @param Product $product
     */
    public static function deleteProduct(Product $product): void
    {
        ProductModel::query()->where('SKU', $product->getSKU())->delete();
        unlink($product->getImage());
    }

    /**
     * @param Product $product
     */
    public static function editProduct(Product $product): void
    {
        ProductModel::query()->where('Id', $product->getId())->update([
            'CategoryId' => $product->getCategoryId(),
            'SKU' => $product->getSku(),
            'Title' => $product->getTitle(),
            'Brand' => $product->getBrand(),
            'Price' => $product->getPrice(),
            'ShortDescription' => $product->getShortDescription(),
            'Description' => $product->getDescription(),
            'Enabled' => $product->getEnabled(),
            'Featured' => $product->getFeatured()
        ]);
    }

    /**
     * Returns most viewed product.
     *
     * @return ProductModel
     */
    public static function getMostViewedProduct(): ProductModel
    {
        return ProductModel::query()->orderBy('ViewCount', 'desc')->first();
    }

    /**
     * Returns all featured products from database.
     *
     * @return Collection|null
     */
    public static function getFeaturedProducts(): ?Collection
    {
        return ProductModel::query()->where('Featured', 1)->get();
    }

    /**
     * Returns products that belong to given category.
     *
     * @param string $categoryCode
     *
     * @return Collection|null
     */
    public static function getProductsByCategoryCode(string $categoryCode): ?Collection
    {
        $category = Category::where('Code', $categoryCode)->first();

        return ProductModel::query()->where('CategoryId', $category->Id)->get();
    }

    /**
     * Returns all products by category code.
     *
     * @param string $categoryCode
     *
     * @return Collection|null
     */
    public static function getAllProductsByCategoryCode(string $categoryCode): ?Collection
    {
        $category = Category::where('Code', $categoryCode)->first();

        return ProductModel::query()->where('CategoryId', $category->Id)->get();
    }

    /**
     * Returns products with given ParentId.
     *
     * @param int $id
     * @param string $column
     * @param string $sortingDirection
     * @param int $productsPerPage
     * @param int $offset
     *
     * @return array|null
     */
    public static function getProductsById(
        int $id,
        string $column,
        string $sortingDirection,
        int $productsPerPage,
        int $offset
    ): ?Collection {
        return ProductModel::query()->where('CategoryId', $id)->offset($offset)->orderBy($column,
            $sortingDirection)->limit($productsPerPage)->get();
    }

    /**
     * Returns products for given ParentIds.
     *
     * @param array $ids
     * @param string $column
     * @param string $sortingDirection
     * @param int $productsPerPage
     * @param int $offset
     *
     * @return Collection
     */
    public static function getProductsByIds(
        array $ids,
        string $column,
        string $sortingDirection,
        int $productsPerPage,
        int $offset
    ): Collection {
        return ProductModel::query()->whereIn('CategoryId', $ids)->offset($offset)->orderBy($column,
            $sortingDirection)->limit($productsPerPage)->get();
    }

    /**
     * Returns number of products by Ids.
     *
     * @param array $ids
     * @param string $column
     * @param string $sortingDirection
     *
     * @return int
     */
    public static function getProductsNumberByIds(
        array $ids,
        string $column,
        string $sortingDirection
    ): int {
        return ProductModel::query()->whereIn('CategoryId', $ids)->orderBy($column, $sortingDirection)->get()->count();
    }

    /**
     * Returns number of products by Id.
     *
     * @param int $id
     * @param string $column
     * @param string $sortingDirection
     *
     * @return int
     */
    public static function getProductsNumberById(
        int $id,
        string $column,
        string $sortingDirection
    ): int {
        return ProductModel::query()->where('CategoryId', $id)->orderBy($column, $sortingDirection)->get()->count();
    }

    /**
     * Returns number of products that satisfy search criteria.
     *
     * @param ParameterSearch $searchParam
     *
     * @return int
     */
    public static function countNumberProducts(
        $searchParam
    ): int {
        $productQuery = RelevanceView::query();

        if (!empty($searchParam->categoryInfo)) {
            $productQuery->whereIn('CategoryId', $searchParam->categoryInfo);
        }

        if (!empty($searchParam->keyword)) {

            $productQuery->where(function ($query) use ($searchParam) {
                return $query->where('Title', 'like', '%' . $searchParam->keyword . '%')->
                orWhere('Brand', 'like', '%' . $searchParam->keyword . '%')->
                orWhere('CategoryTitle', 'like', '%' . $searchParam->keyword . '%')->
                orWhere('ShortDescription', 'like', '%' . $searchParam->keyword . '%')->
                orWhere('Description', 'like', '%' . $searchParam->keyword . '%');
            });
        }

        if ($searchParam->minPrice !== null && $searchParam->maxPrice !== null) {
            if ($searchParam->minPrice !== $searchParam->maxPrice) {
                $productQuery->whereBetween('Price', [$searchParam->minPrice, $searchParam->maxPrice]);
            }
        }

        if (!empty($searchParam->keyword)) {
            $productQuery->orderByRaw("CASE WHEN Title LIKE '%" . $searchParam->keyword . "%' THEN 1 " .
                " WHEN Brand LIKE '%" . $searchParam->keyword . "%' THEN 2 " .
                " WHEN CategoryTitle LIKE '%" . $searchParam->keyword . "%' THEN 3 " .
                " WHEN ShortDescription LIKE '%" . $searchParam->keyword . "%' THEN 4 " .
                " WHEN Description LIKE '%" . $searchParam->keyword . "%' THEN 5 END ASC");
        }

        return $productQuery->distinct()->count();
    }

    /**
     * Returns products that match search criteria.
     *
     * @param ParameterSearch $searchParam
     *
     * @return \Illuminate\Support\Collection
     */
    public static function searchProducts(
        ParameterSearch $searchParam
    ): \Illuminate\Support\Collection {
        $productQuery = RelevanceView::query();

        if (!empty($searchParam->categoryInfo)) {
            $productQuery->whereIn('CategoryId', $searchParam->categoryInfo);
        }

        if (!empty($searchParam->keyword)) {

            $productQuery->where(function ($query) use ($searchParam) {
                return $query->where('Title', 'like', '%' . $searchParam->keyword . '%')->
                orWhere('Brand', 'like', '%' . $searchParam->keyword . '%')->
                orWhere('CategoryTitle', 'like', '%' . $searchParam->keyword . '%')->
                orWhere('ShortDescription', 'like', '%' . $searchParam->keyword . '%')->
                orWhere('Description', 'like', '%' . $searchParam->keyword . '%');
            });
        }

        if ($searchParam->minPrice !== null && $searchParam->maxPrice !== null) {
            if ($searchParam->minPrice !== $searchParam->maxPrice) {
                $productQuery->whereBetween('Price', [$searchParam->minPrice, $searchParam->maxPrice]);
            }
        }

        if (!empty($searchParam->keyword)) {
            $productQuery->orderByRaw("CASE WHEN Title LIKE '%" . $searchParam->keyword . "%' THEN 1 " .
                " WHEN Brand LIKE '%" . $searchParam->keyword . "%' THEN 2 " .
                " WHEN CategoryTitle LIKE '%" . $searchParam->keyword . "%' THEN 3 " .
                " WHEN ShortDescription LIKE '%" . $searchParam->keyword . "%' THEN 4 " .
                " WHEN Description LIKE '%" . $searchParam->keyword . "%' THEN 5 END ASC");
        }

        return $productQuery->distinct()->offset($searchParam->offset)->limit($searchParam->limit)->get();
    }

}



