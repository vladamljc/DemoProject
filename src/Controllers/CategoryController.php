<?php

namespace Catalog\Controllers;

use Catalog\Data\Beans\CategoryBean;
use Catalog\Data\Beans\EditCategoryBean;
use Catalog\Data\DTO\Category;
use Catalog\Data\Validation\CategoryValidator;
use Catalog\Http\HTMLResponse;
use Catalog\Http\JSONResponse;
use Catalog\Http\Request;
use Catalog\Http\Response;
use Catalog\Services\CategoryService;
use Catalog\Utility\ViewRenderer;
use Exception;

/**
 * Class CategoryController
 *
 * @package Catalog\Controllers
 */
class CategoryController extends AdminController
{
    /**
     * Generates view for admin dashboard page and returns it within response.
     *
     * @return Response
     */
    public function index(): Response
    {
        $response = new HTMLResponse();
        $response->setContent(ViewRenderer::render('views/admin/AdminCategoriesPage'));

        return $response;
    }

    /**
     * Method to add new Category to database.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addCategory(Request $request): Response
    {
        $data = json_decode($request->getBody());

        if (CategoryValidator::validateInputCategory($data->title, $data->code, $data->description, $data->parentId)) {
            return new JSONResponse([
                'success' => false,
                'message' => CategoryValidator::getErrorMessage()
            ]);
        }

        if ($data->parentId === '-1') {
            $categoryDTO = new Category(-1, $data->code, $data->title, $data->description);
        } else {
            $parentCategoryDTO = CategoryService::getCategoryById($data->parentId);
            $categoryDTO = new Category($parentCategoryDTO->getId(), $data->code, $data->title, $data->description);
        }
        CategoryService::addCategory($categoryDTO);

        return new JSONResponse(['success' => true, 'message' => 'New category added.']);
    }

    /**
     * Method that is used to render login form when user clicks on the button to add new category.
     *
     * @return Response
     */
    public function showAddNewCategoryForm(): Response
    {
        $response = new HTMLResponse();
        $response->setContent(ViewRenderer::render('views/snippets/admin/categories/NewCategoryView'));

        return $response;
    }

    /**
     * Returns form for adding new sub-category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function showAddNewSubCategoryForm(Request $request): Response
    {
        $parentCode = $request->getQuery()['parentCode'];

        $categoryDTO = CategoryService::getCategoryByCode($parentCode);

        $response = new HTMLResponse();

        if ($categoryDTO) {

            $response->setContent(ViewRenderer::render('views/snippets/admin/categories/NewSubCategoryView',
                ['title' => $categoryDTO->getTitle(), 'id' => $categoryDTO->getId()]));

            return $response;
        }

        $response->setContent('Error loading sub-category form');

        return $response;
    }

    /**
     * Returns selected category information.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function showSelectedCategory(Request $request): Response
    {
        $code = $request->getQuery()['code'];

        $response = new HTMLResponse();

        $categoryDTO = CategoryService::getCategoryByCode($code);

        if ($categoryDTO) {
            $categoryData = array();
            $categoryData['id'] = $categoryDTO->getId();
            $categoryData['title'] = $categoryDTO->getTitle();

            if ($categoryDTO->getParentId() === -1) {
                $categoryData['parentTitle'] = 'Root';
            } else {
                $parentCategoryDTO = CategoryService::getCategoryById($categoryDTO->getParentId());
                $categoryData['parentTitle'] = $parentCategoryDTO->getTitle();
            }

            $categoryData['description'] = $categoryDTO->getDescription();
            $categoryData['code'] = $categoryDTO->getCode();

            $response->setContent(ViewRenderer::render('views/snippets/admin/categories/SelectedCategory',
                $categoryData));
        }

        return $response;
    }

    /**
     * Returns all categories from database.
     *
     * @return JSONResponse
     */
    public function getAllCategories(): JSONResponse
    {
        $categoriesDTO = CategoryService::getAllCategories();
        $categories = array();

        foreach ($categoriesDTO as $category) {
            $categoryBean = new CategoryBean($category->getId(), $category->getTitle(), $category->getParentId(),
                $category->getCode());
            $categories[] = $categoryBean;
        }

        return new JSONResponse($categories);
    }

    /**
     * Returns form for editing selected category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getEditCategoryView(Request $request): Response
    {
        $receivedCode = $request->getQuery()['code'];

        $categoryDTO = CategoryService::getCategoryByCode($receivedCode);
        $categoryData = array();
        $categoryData['title'] = $categoryDTO->getTitle();

        $allCategories = array();
        $allCategoriesDTO = CategoryService::getAllCategories();
        foreach ($allCategoriesDTO as $model) {
            $categoryBean = new EditCategoryBean($model->getCode(), $model->getTitle(), $model->getId());
            $allCategories[] = $categoryBean;
        }
        $categoryRootBean = new EditCategoryBean('-1', 'Root', -1);
        $allCategories[] = $categoryRootBean;

        $categoryData['parentTitles'] = $allCategories;

        $categoryData['code'] = $categoryDTO->getCode();
        $categoryData['description'] = $categoryDTO->getDescription();

        $categoryData['id'] = $categoryDTO->getId();
        $categoryData['parentId'] = $categoryDTO->getParentId();

        $response = new HTMLResponse();

        $response->setContent(ViewRenderer::render('views/snippets/admin/categories/EditCategoryView',
            $categoryData));

        return $response;
    }

    /**
     * Method to edit/update category/subcategory
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editCategory(Request $request): Response
    {
        $data = json_decode($request->getBody());

        if (CategoryValidator::validateEditCategory($data->title, $data->code, $data->description, $data->parentCode,
            $data->idCategory)) {
            return new JSONResponse(['success' => false, 'message' => CategoryValidator::getErrorMessage()]);
        }

        if ($data->parentCode !== '-1') {
            $parentCategoryDTO = CategoryService::getCategoryByCode($data->parentCode);
            $idParentCategory = $parentCategoryDTO->getId();
        } else {
            $idParentCategory = '-1';
        }

        $categoryOriginal = CategoryService::getCategoryById($data->idCategory);
        $idCategoryOriginal = $categoryOriginal->getId();

        $categoryUpdated = new Category($idParentCategory, $data->code, $data->title, $data->description,
            $idCategoryOriginal);

        CategoryService::editCategory($categoryUpdated);

        return new JSONResponse(['success' => true, 'message' => 'Category edited successfully.']);
    }

    /**
     * Method to delete category from database
     *
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function deleteCategory(Request $request): Response
    {

        $data = json_decode($request->getBody());

        if (empty($data->code)) {
            return new JSONResponse(['success' => false, 'message' => 'Failed to delete category.']);
        }

        $categoryDTO = CategoryService::getCategoryByCode($data->code);

        if (CategoryService::deleteCategory($categoryDTO)) {
            return new JSONResponse([
                'success' => false,
                'message' => 'There are products with this category. Can not delete.'
            ]);
        }

        return new JSONResponse(['success' => true, 'message' => 'Category deleted successfully.']);
    }

}