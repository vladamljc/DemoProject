<?php

namespace Catalog\Controllers;

use Catalog\Data\CategoryBean;
use Catalog\Http\HTMLResponse;
use Catalog\Http\JSONResponse;
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
     * method to add new Category to database
     *
     * @return Response
     */
    public function addCategory(): Response
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['title']) || empty($data['code']) || empty($data['description'])) {
            return new JSONResponse([
                'success' => false,
                'message' => 'Some of inputted fields maybe empty or json objects might be null...'
            ]);
        }
        CategoryService::addCategory($data['code'], $data['title'], $data['description']);

        return new JSONResponse(['success' => true, 'message' => 'New category added...']);
    }

    /**
     * method to add new sub-category to database
     *
     * @return Response
     */
    public function addSubCategory(): Response
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['title']) || empty($data['code']) || empty($data['description']) || empty($data['parent'])) {
            return new JSONResponse([
                'success' => false,
                'message' => 'Some of inputted fields maybe empty or json objects might be null...'
            ]);
        }

        $categoryModel = CategoryService::getCategoryByTitle($data['parent']);

        if ($categoryModel === null) {
            return JSONResponse([
                'success' => false,
                'message' => 'Sub-category parent does not exist'
            ]);
        }

        $categoryId = $categoryModel->Id;

        CategoryService::addCategory($data['code'], $data['title'], $data['description'], $categoryId);

        return new JSONResponse(['success' => true, 'message' => 'New sub-category added...']);
    }

    /**
     * method that is used to render login form when user clicked on the button to add new category
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
     * returns form for adding new sub-category
     *
     * @return Response
     */
    public function showAddNewSubCategoryForm(): Response
    {

        $parentCode = $_GET['parentCode'];

        $categoryModel = CategoryService::getCategoryByCode($parentCode);

        $response = new HTMLResponse();

        $response->setContent(ViewRenderer::render('views/snippets/admin/categories/NewSubCategoryView',
            [$categoryModel->Title, $categoryModel->Code]));

        return $response;
    }

    /**
     * returns selected category information
     *
     * @return Response
     */
    public function showSelectedCategory(): Response
    {

        $titleName = $_GET['paramTitle'];

        $response = new HTMLResponse();

        $categoryModel = CategoryService::getCategoryByTitle($titleName);

        $categoryData = array();
        $categoryData[] = $categoryModel->Id;
        $categoryData[] = $categoryModel->Title;

        if ($categoryModel->ParentId === -1) {
            $categoryData[] = 'root';
        } else {
            $parent = CategoryService::getCategoryById($categoryModel->ParentId);
            $categoryData[] = $parent->Title;
        }

        $categoryData[] = $categoryModel->Description;
        $categoryData[] = $categoryModel->Code;

        $response->setContent(ViewRenderer::render('views/snippets/admin/categories/SelectedCategory', $categoryData));

        return $response;
    }

    /**
     * returns all categories from database
     *
     * @return JSONResponse
     */
    public function getAllCategories(): JSONResponse
    {
        header('Content-Type: application/json');
        $categoriesModel = CategoryService::getAllCategories();
        $categories = array();

        foreach ($categoriesModel as $model) {
            $obj = new CategoryBean($model->Id, $model->Title, $model->ParentId);
            $categories[] = $obj;
        }

        return new JSONResponse($categories);
    }

    /**
     * returns form for editing selected category
     *
     * @return Response
     */
    public function getEditCategoryView(): Response
    {
        $receivedCode = $_GET['code'];
        $receivedParent = $_GET['parent'];

        $categoryModel = CategoryService::getCategoryByCode($receivedCode);
        $categoryData = array();
        $categoryData[] = $categoryModel->Title;

        $allCategories = array();
        $allCategoriesModels = CategoryService::getAllCategories();
        foreach ($allCategoriesModels as $model) {
            $allCategories[] = $model->Title;
        }
        $allCategories[] = 'root';

        $categoryData[] = $allCategories;

        $categoryData[] = $categoryModel->Code;
        $categoryData[] = $categoryModel->Description;

        $categoryData[] = $receivedParent;
        $categoryData[] = $categoryModel->Id;

        $response = new HTMLResponse();

        $response->setContent(ViewRenderer::render('views/snippets/admin/categories/EditCategoryView',
            $categoryData));

        return $response;
    }

    /**
     * method to edit/update category/subcategory
     *
     * @return Response
     */
    public function editCategory(): Response
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['title']) || empty($data['code']) || empty($data['parent']) || empty($data['description']) || empty($data['id'])) {
            return new JSONResponse(['success' => false, 'message' => 'Updating category/subcategory failed...']);
        }
        $titleEdited = $data['title'];
        $codeEdited = $data['code'];
        $parentEdited = $data['parent'];
        $descriptionEdited = $data['description'];
        $categoryId = $data['id'];

        $modelCategory = CategoryService::getCategoryByTitle($parentEdited);

        CategoryService::editCategory($categoryId, $codeEdited, $titleEdited, $descriptionEdited, $modelCategory->Id);

        return new JSONResponse(['success' => true, 'message' => 'Category edited successfully...']);
    }

    /**
     * method to delete category from database
     *
     * @return Response
     * @throws Exception
     */
    public function deleteCategory(): Response
    {

        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['code'])) {
            return new JSONResponse(['success' => false, 'message' => 'Failed to delete category...']);
        }

        $categoryModel = CategoryService::getCategoryByCode($data['code']);

        CategoryService::deleteCategory($categoryModel->Id);

        return new JSONResponse(['success' => true, 'message' => 'Category deleted successfully...']);
    }

}