<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\Models\Category;
use Exception;
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
     * @param Category $newCategory
     */
    public static function addCategory(Category $newCategory): void
    {
        $newCategory->save();
    }

    /**
     * method used to delete Category from database
     *
     * @param int $Id
     *
     * @throws Exception
     */
    public static function deleteCategory(int $Id): void
    {
        $category = Category::find($Id);
        $category->delete();
    }

    /**
     * method used to edit/update Category in database
     *
     * @param int $Id
     * @param string $Code
     * @param string $Title
     * @param string $Description
     */
    public static function editCategory(int $Id, string $Code, string $Title, string $Description): void
    {
        $category = Category::find($Id);
        $category->Code = $Code;
        $category->Title = $Title;
        $category->Description;
        $category->save();
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

}