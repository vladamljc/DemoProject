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
     * @param int $Id
     * @param string $Code
     * @param string $Title
     * @param string $Description
     * @param int $IdParent
     */
    public static function editCategory(int $Id, string $Code, string $Title, string $Description, int $IdParent): void
    {
        Category::where('Id', $Id)->update([
            'Code' => $Code,
            'Title' => $Title,
            'Description' => $Description,
            'ParentId' => $IdParent
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
     * @param CategoryDTO $category
     *
     * @return bool
     */
    public static function hasProducts(CategoryDTO $category): bool
    {
        return Product::where('CategoryId', $category->getId())->exists();
    }

}