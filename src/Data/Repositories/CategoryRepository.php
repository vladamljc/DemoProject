<?php

namespace Catalog\Data\Repositories;

use Catalog\Data\Models\Category;
use Catalog\Database\Database;

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
        Database::getConnection();
        $newCategory->save();
    }

    /**
     * method used to add new SubCategory to database
     *
     * @param Category $newSubCategory
     */
    public static function addSubCategory(Category $newSubCategory): void
    {
        Database::getConnection();
        $newSubCategory->save();
    }

    /**
     * method used to delete Category from database
     *
     * @param int $Id
     */
    public static function deleteCategory(int $Id): void
    {
        Database::getConnection();
        $category = Category::find($Id);
        $category->delete();
    }

    /**
     * method used to edit/update Category in database
     *
     * @param int $Id
     * @param string $Code
     * @param string $Title
     * @param $Description
     */
    public static function editCategory(int $Id, string $Code, string $Title, $Description): void
    {
        Database::getConnection();
        $category = Category::find($Id);
        $category->Code = $Code;
        $category->Title = $Title;
        $category->Description;
        $category->save();
    }

}