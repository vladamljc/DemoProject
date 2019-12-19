<?php

namespace Catalog\Controllers;

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

}