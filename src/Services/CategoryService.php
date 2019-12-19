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
     * @param int $ParentId
     */
    public static function addCategory(string $Code, string $Title, $Description, $ParentId = -1): void
    {
        $newCategory = new Category();
        $newCategory->Code = $Code;
        $newCategory->Title = $Title;
        $newCategory->Description = $Description;
        $newCategory->ParentId = $ParentId;
        CategoryRepository::addCategory($newCategory);
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