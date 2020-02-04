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
     *Method to add new category/subcategory to database
     *
     * @param CategoryDTO $categoryDTO
     */
    public static function addCategory(CategoryDTO $categoryDTO): void
    {
        CategoryRepository::addCategory($categoryDTO);
    }

    /**
     * Method to edit category in database
     *
     * @param CategoryDTO $categoryDTO
     */
    public static function editCategory(CategoryDTO $categoryDTO): void
    {
        CategoryRepository::editCategory($categoryDTO);
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
        }

        return new CategoryDTO($category->ParentId, $category->Code, $category->Title, $category->Description,
            $category->Id);
    }

    /**
     * Returns number of categories.
     *
     * @return int
     */
    public static function getNumberOfCategories(): int
    {
        return CategoryRepository::getNumberOfCategories();
    }

    /**
     * Returns selected category and it's children.
     *
     * @param int $id
     *
     * @return array
     */
    public static function getChildrenIds(int $id): array
    {
        $ids = array();
        $childrenIds = CategoryRepository::getChildrenIds($id);
        foreach ($childrenIds as $childrenId) {
            $ids[] = $childrenId;
        }

        return $ids;
    }

    /**
     * Returns number of children(sub-categories) for given category.
     *
     * @param int $id
     *
     * @return int
     */
    public static function getChildrenCount(int $id): int
    {
        return CategoryRepository::getChildrenCount($id);
    }

    /**
     * Returns all categories that match name
     *
     * @param string $categoryName
     *
     * @return array|null
     */
    public static function getCategoriesByName(string $categoryName): ?array
    {
        $ids = array();
        $categories = CategoryRepository::getCategoriesByName($categoryName);
        if ($categories !== null) {
            foreach ($categories as $category) {
                $ids[] = $category->Id;
                $childrenIds = self::getChildrenIds($category->Id);
                foreach ($childrenIds as $childrenId) {
                    $ids[] = $childrenId;
                }
            }

            return $ids;
        }

        return null;
    }

}