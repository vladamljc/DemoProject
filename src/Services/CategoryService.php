<?php

namespace Catalog\Services;

use Catalog\Data\Models\Category;
use Catalog\Data\Repositories\CategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

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
     * @param string $Description
     * @param int $IdParent
     */
    public static function editCategory(int $Id, string $Code, string $Title, string $Description, int $IdParent): void
    {
        CategoryRepository::editCategory($Id, $Code, $Title, $Description, $IdParent);
    }

    /**
     * @param int $Id
     *
     * @throws Exception
     */
    public static function deleteCategory(int $Id): void
    {
        CategoryRepository::deleteCategory($Id);
    }

    /**
     * @return Collection|null
     */
    public static function getRootCategories(): ?Collection
    {
        return CategoryRepository::getRootCategories();
    }

    /**
     * @param string $categoryTitle
     *
     * @return Category|null
     */
    public static function getCategoryByTitle(string $categoryTitle): ?Category
    {
        return CategoryRepository::getCategoryByTitle($categoryTitle);
    }

    /**
     * @return Collection|null
     */
    public static function getAllCategories(): ?Collection
    {
        return CategoryRepository::getAllCategories();
    }

    /**
     * @param int $categoryId
     *
     * @return Category|null
     */
    public static function getCategoryById(int $categoryId): ?Category
    {
        return CategoryRepository::getCategoryById($categoryId);
    }

    /**
     * @param string $code
     *
     * @return Category|null
     */
    public static function getCategoryByCode(string $code): ?Category
    {
        return CategoryRepository::getCategoryByCode($code);
    }

}