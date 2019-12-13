<?php

namespace Catalog\Services;

use Catalog\Data\Models\Category;
use Catalog\Data\Repositories\CategoryRepository;

/**
 * Class CategoryService
 *
 * @package Catalog\Services
 */
class CategoryService
{

    /**
     * @param string $Code
     * @param string $Title
     * @param $Description
     */
    public static function addCategory(string $Code, string $Title, $Description): void
    {
        $newCategory = new Category();
        $newCategory->Code = $Code;
        $newCategory->Title = $Title;
        $newCategory->Description = $Description;
        CategoryRepository::addCategory($newCategory);
    }

    /**
     * @param string $Code
     * @param string $Title
     * @param $Description
     * @param $IdParent
     */
    public static function addSubCategory(string $Code, string $Title, $Description, $IdParent)
    {
        $newCategory = new Category();
        $newCategory->Code = $Code;
        $newCategory->Title = $Title;
        $newCategory->Description = $Description;
        $newCategory->ParentId = $IdParent;
        CategoryRepository::addSubCategory($newCategory);
    }

    /**
     * @param int $Id
     * @param string $Code
     * @param string $Title
     * @param $Description
     */
    public static function editCategory(int $Id, string $Code, string $Title, $Description)
    {
        CategoryRepository::editCategory($Id, $Code, $Title, $Description);
    }

    /**
     * @param int $Id
     */
    public static function deleteCategory(int $Id): void
    {
        CategoryRepository::deleteCategory($Id);
    }
}