<?php

namespace Catalog\Controllers;

use Catalog\Data\CategoryBean;
use Catalog\Http\HTMLResponse;
use Catalog\Http\JSONResponse;
use Catalog\Http\Response;
use Catalog\Services\CategoryService;
use Catalog\Utility\ViewRenderer;

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

        $parentTitle = $_GET['parentTitle'];

        $response = new HTMLResponse();

        $response->setContent(ViewRenderer::render('views/snippets/admin/categories/NewSubCategoryView',
            [$parentTitle]));

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
        $categoriesModel = CategoryService::getAllCategories();
        $categories = array();

        foreach ($categoriesModel as $model) {
            $obj = new CategoryBean($model->Id, $model->Title, $model->ParentId);
            $categories[] = $obj;
        }

        return new JSONResponse($categories);
    }

}