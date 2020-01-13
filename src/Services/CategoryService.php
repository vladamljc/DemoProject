<?php

namespace Catalog\Services;

use Catalog\Data\DTO\Category as CategoryDTO;
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
     * @param CategoryDTO $categoryDTO
     */
    public static function addCategory(CategoryDTO $categoryDTO): void
    {
        CategoryRepository::addCategory($categoryDTO);
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
     * @param CategoryDTO $categoryDTO
     *
     * @return bool
     * @throws Exception
     */
    public static function deleteCategory(CategoryDTO $categoryDTO): bool
    {
        if (CategoryRepository::hasProducts($categoryDTO)) {
            return true;
        }
        CategoryRepository::deleteCategory($categoryDTO);

        return false;
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
     * @return array|null
     */
    public static function getAllCategories(): ?array
    {
        $categories = CategoryRepository::getAllCategories();
        if (!empty($categories)) {
            $categoriesDTO = array();
            foreach ($categories as $category) {
                $categoriesDTO[] = new CategoryDTO($category->ParentId, $category->Code, $category->Title,
                    $category->Description, $category->Id);
            }

            return $categoriesDTO;
        }

        return null;
    }

    /**
     * @param int $categoryId
     *
     * @return Category|null
     */
    public static function getCategoryById(int $categoryId): ?CategoryDTO
    {
        $category = CategoryRepository::getCategoryById($categoryId);

        return new CategoryDTO($category->ParentId, $category->Code, $category->Title, $category->Description,
            $category->Id);
    }

    /**
     * @param string $code
     *
     * @return CategoryDTO|null
     */
    public static function getCategoryByCode(string $code): ?CategoryDTO
    {
        $category = CategoryRepository::getCategoryByCode($code);
        if (empty($category)) {
            return null;
        } else {
            return new CategoryDTO($category->ParentId, $category->Code, $category->Title, $category->Description,
                $category->Id);
        }
    }

}