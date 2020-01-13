<?php

namespace Catalog\Controllers;

use Catalog\Data\Beans\CategoryBean;
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
     * Method to edit/update category/subcategory
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

        return new JSONResponse(['success' => true, 'message' => 'Category edited successfully.']);
    }

    /**
     * Method to delete category from database
     *
     * @return Response
     * @throws Exception
     */
    public function deleteCategory(): Response
    {

        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['code'])) {
            return new JSONResponse(['success' => false, 'message' => 'Failed to delete category.']);
        }

        $categoryModel = CategoryService::getCategoryByCode($data['code']);

        CategoryService::deleteCategory($categoryModel->Id);

        return new JSONResponse(['success' => true, 'message' => 'Category deleted successfully.']);
    }

}