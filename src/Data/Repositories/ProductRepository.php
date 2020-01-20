<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\DTO\Product;
use Catalog\Data\Models\Product as ProductModel;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductRepository
 *
 * @package Catalog\Data\Repositories
 */
class ProductRepository
{
    /**
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
     * @param string $sku
     *
     * @return ProductDTO | null
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
        ProductModel::where('SKU', $sku)->update([
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

        return ProductModel::offset($pageOffset * 10)->limit(10)->get();
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
            ProductModel::where('SKU', $product->getSKU())->update([
                'Enabled' => 1
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
            ProductModel::where('SKU', $product->getSKU())->delete();
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
        ProductModel::where('SKU', $product->getSKU())->delete();
        unlink($product->getImage());
    }

    /**
     * @param Product $product
     */
    public static function editProduct(Product $product): void
    {
        ProductModel::where('Id', $product->getId())->update([
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
}