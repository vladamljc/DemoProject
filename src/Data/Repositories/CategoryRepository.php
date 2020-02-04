<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\DTO\Category as CategoryDTO;
use Catalog\Data\Models\Category;
use Catalog\Data\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CategoryRepository
 *
 * @package Catalog\Data\Repositories
 */
class CategoryRepository
{

    /**
     * method used to add new Category to database
     *
     * @param CategoryDTO $categoryDTO
     */
    public static function addCategory(CategoryDTO $categoryDTO): void
    {
        $newCategory = new Category();
        $newCategory->Title = $categoryDTO->getTitle();
        $newCategory->Code = $categoryDTO->getCode();
        $newCategory->Description = $categoryDTO->getDescription();
        $newCategory->ParentId = $categoryDTO->getParentId();
        $newCategory->save();
    }

    /**
     * method used to delete Category from database
     *
     * @param CategoryDTO $categoryDTO
     */
    public static function deleteCategory(CategoryDTO $categoryDTO): void
    {
        Category::where('Id', $categoryDTO->getId())->delete();
    }

    /**
     * method used to edit/update Category in database
     *
     * @param CategoryDTO $categoryDTO
     */
    public static function editCategory(CategoryDTO $categoryDTO): void
    {
        Category::where('Id', $categoryDTO->getId())->update([
            'Code' => $categoryDTO->getCode(),
            'Title' => $categoryDTO->getTitle(),
            'Description' => $categoryDTO->getDescription(),
            'ParentId' => $categoryDTO->getParentId()
        ]);
    }

    /**
     * returns all root Categories from database
     *
     * @return Collection
     */
    public static function getRootCategories(): Collection
    {
        return Category::where('ParentId', -1)->get();
    }

    /**
     * @param string $categoryTitle
     *
     * @return Category|null
     */
    public static function getCategoryByTitle(string $categoryTitle): ?Category
    {
        return Category::where('Title', $categoryTitle)->first();
    }

    /**
     * @return Collection|null
     */
    public static function getAllCategories(): ?Collection
    {
        return Category::all();
    }

    /**
     * @param int $categoryId
     *
     * @return Category|null
     */
    public static function getCategoryById(int $categoryId): ?Category
    {
        return Category::where('Id', $categoryId)->first();
    }

    /**
     * @param string $code
     *
     * @return Category|null
     */
    public static function getCategoryByCode(string $code): ?Category
    {
        return Category::where('Code', $code)->first();
    }

    /**
     * Checks if there are any products that reference given category.
     *
     * @param CategoryDTO $category
     *
     * @return bool
     */
    public static function hasProducts(CategoryDTO $category): bool
    {
        return Product::where('CategoryId', $category->getId())->exists();
    }

    /**
     * Returns number of categories.
     *
     * @return int
     */
    public static function getNumberOfCategories(): int
    {
        return Category::all()->count();
    }

    /**
     * Returns Ids for all children for given category.
     *
     * @param int $id
     *
     * @return Collection
     */
    public static function getChildrenIds(int $id): \Illuminate\Support\Collection
    {
        $category = Category::query()->where('Id', $id)->first();

        return $category->children()->get()->pluck('Id');
    }

    /**
     * Returns number of children for given category by id.
     *
     * @param int $id
     *
     * @return int
     */
    public static function getChildrenCount(int $id): int
    {
        return Category::query()->where('ParentId', $id)->count();
    }

    /**
     * @param string $categoryName
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getCategoriesByName(string $categoryName): \Illuminate\Support\Collection
    {
        return Category::query()->where('Title', 'like', '%' . $categoryName . '%')->get();
    }

}