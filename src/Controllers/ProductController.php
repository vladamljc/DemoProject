<?php

namespace Catalog\Controllers;

use Catalog\Data\DTO\Product;
use Catalog\Data\Validation\ProductValidator;
use Catalog\Http\HTMLResponse;
use Catalog\Http\JSONResponse;
use Catalog\Http\Request;
use Catalog\Http\Response;
use Catalog\Services\CategoryService;
use Catalog\Services\ProductService;
use Catalog\Utility\SelectCategoryBean;
use Catalog\Utility\ViewRenderer;

/**
 * Class ProductController
 *
 * @package Catalog\Controllers
 */
class ProductController extends AdminController
{
    /**
     * Generates view for admin dashboard page and returns it within response.
     *
     * @return Response
     */
    public function index(): Response
    {
        $response = new HTMLResponse();
        $response->setContent(ViewRenderer::render('views/admin/AdminProductPage'));

        return $response;
    }

    /**
     * returns add new product page
     *
     * @return Response
     */
    public function getAddNewProductView(): Response
    {
        $response = new HTMLResponse();
        $allCategories = CategoryService::getAllCategories();
        $categories = array();
        foreach ($allCategories as $category) {
            $categoryBean = new SelectCategoryBean($category->getTitle(), $category->getCode());
            $categories[] = $categoryBean;
        }
        $response->setContent(ViewRenderer::render('views/snippets/admin/products/CreateNewProductView', $categories));

        return $response;
    }

    /**
     * method that is used to add new product
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addNewProduct(Request $request): Response
    {
        header('Content-Type: application/json');
        $bodyString = $request->getBody();
        $data = json_decode($bodyString);

        if (empty($data->SKU) || empty($data->Title) || empty($data->Brand) || empty($data->CategoryCode) || empty($data->Price) || empty($data->ShortDescription) || empty($data->Description)) {
            return new JSONResponse(['success' => false, 'message' => 'All fields are required!']);
        }
        if (!is_numeric($data->Price)) {
            return new JSONResponse(['success' => false, 'message' => 'ERROR: Price must be a number!']);
        }

        $categoryDTO = CategoryService::getCategoryByCode($data->CategoryCode);

        $newProduct = new Product($categoryDTO->getId(), $data->SKU, $data->Title, $data->Brand, $data->Price,
            $data->ShortDescription, $data->Description, '', $data->Enabled, $data->Featured, 0);

        ProductService::addNewProduct($newProduct);

        return new JSONResponse(['success' => true, 'message' => 'Product added successfully.']);
    }

    /**
     * upload product image method
     *
     * @param Request $request
     *
     * @return Response
     */
    public function uploadProductImage(Request $request): Response
    {
        $sku = $request->getPost()['SKU'];

        if (ProductService::getProductBySKU($sku) !== null) {

            //$ratio = $imageHeight / $imageWidth;
//
//            if ($ratio < 4 / 3 || $ratio > 16 / 9) {
//                return new JSONResponse([
//                    'success' => false,
//                    'message' => 'ERROR: Image height/width ratio must be between 4/3 and 16/9.'
//                ]);
//            }

//            if ($imageWidth < 600) {
//                return new JSONResponse([
//                    'success' => false,
//                    'message' => 'ERROR: Image width must have at least 600pxs.'
//                ]);
//            }

            $target_dir = __DIR__ . '/../../public/assets/Images/';
            $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
            ProductService::updateProductImageBySKU($sku, $target_file);

            return new JSONResponse(['success' => true, 'message' => 'Image uploaded successfully.']);
        }

        return new JSONResponse(['success' => false, 'message' => 'Image not uploaded successfully.']);
    }

    /**
     * Method that returns 10 products per page
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getPage(Request $request): Response
    {
        $response = new HTMLResponse();

        $listOfProducts = ProductService::getPage($request->getQuery()['pageId']);

        $products = array();
        $products['listOfProducts'] = $listOfProducts;
        $products['numOfProducts'] = ProductService::getNumberOfProducts();

        $response->setContent(ViewRenderer::render('views/snippets/admin/products/ListAllProducts',
            $products));

        return $response;
    }

    /**
     * Method used to enable products selected from table.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function enableProducts(Request $request): Response
    {
        $productsJSON = json_decode($request->getBody());

        $products = $productsJSON->sku;
        $productsToEnable = array();

        foreach ($products as $product) {
            $productDTO = ProductService::getProductBySKU($product);
            $productToEnable = new Product($productDTO->getCategoryId(), $productDTO->getSku(), $productDTO->getTitle(),
                $productDTO->getBrand(), $productDTO->getPrice(), $productDTO->getShortDescription(),
                $productDTO->getDescription(), $productDTO->getImage(), $productDTO->getEnabled(),
                $productDTO->getFeatured(), $productDTO->getViewCount());
            $productsToEnable[] = $productToEnable;
        }

        ProductService::enableSelectedProducts($productsToEnable);

        return new JSONResponse(['success' => 'Products successfully enabled.']);
    }

    /**
     * Method used to disable products selected from table.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function disableProducts(Request $request): Response
    {
        $productsJSON = json_decode($request->getBody());

        $products = $productsJSON->sku;
        $productsToDisable = array();

        foreach ($products as $product) {
            $productDTO = ProductService::getProductBySKU($product);
            $productToDisable = new Product($productDTO->getCategoryId(), $productDTO->getSku(),
                $productDTO->getTitle(),
                $productDTO->getBrand(), $productDTO->getPrice(), $productDTO->getShortDescription(),
                $productDTO->getDescription(), $productDTO->getImage(), $productDTO->getEnabled(),
                $productDTO->getFeatured(), $productDTO->getViewCount());
            $productsToDisable[] = $productToDisable;
        }

        ProductService::disableSelectedProducts($productsToDisable);

        return new JSONResponse(['success' => 'Products successfully enabled.']);
    }

    /**
     * Method to delete all selected products
     *
     * @param Request $request
     *
     * @return Response
     */
    public function deleteSelectedProducts(Request $request): Response
    {
        $productsJSON = json_decode($request->getBody());

        $products = $productsJSON->sku;
        $productsToDelete = array();

        foreach ($products as $product) {
            $productDTO = ProductService::getProductBySKU($product);
            $productToDelete = new Product($productDTO->getCategoryId(), $productDTO->getSku(),
                $productDTO->getTitle(),
                $productDTO->getBrand(), $productDTO->getPrice(), $productDTO->getShortDescription(),
                $productDTO->getDescription(), $productDTO->getImage(), $productDTO->getEnabled(),
                $productDTO->getFeatured(), $productDTO->getViewCount());
            $productsToDelete[] = $productToDelete;
        }

        ProductService::deleteSelectedProducts($productsToDelete);

        return new JSONResponse(['message' => 'Products successfully deleted.']);
    }

    /**
     * Method used to delete single product
     *
     * @param Request $request
     *
     * @return Response
     */
    public function deleteProduct(Request $request): Response
    {
        $productJSON = json_decode($request->getBody());
        $productDTO = ProductService::getProductBySKU($productJSON->sku);

        ProductService::deleteProduct($productDTO);

        return new JSONResponse(['message' => 'Product successfully deleted.']);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getEditProductView(Request $request): Response
    {
        $response = new HTMLResponse();

        $productData = array();

        $allCategories = CategoryService::getAllCategories();
        $categories = array();
        foreach ($allCategories as $category) {
            $categoryTemp = CategoryService::getCategoryByCode($category->getCode());

            if ($categoryTemp->getParentId() === -1) {
                $parentTitle = 'Root';
            } else {
                $categoryParent = CategoryService::getCategoryById($categoryTemp->getParentId());
                $parentTitle = $categoryParent->getTitle();
            }
            $categoryBean = new SelectCategoryBean($category->getTitle(), $category->getCode(), $parentTitle);
            $categories[] = $categoryBean;
        }

        $productDTO = ProductService::getProductBySKU($request->getParameters()[0]);

        $categoryDTO = CategoryService::getCategoryById($productDTO->getCategoryId());

        $imageCompletePath = $productDTO->getImage();

        $imagePathPieces = explode('/', $imageCompletePath);
        $numPieces = count($imagePathPieces);

        $imageName = $imagePathPieces[$numPieces - 1];

        $productData['category'] = $categories;
        $productData['productInfo'] = $productDTO;
        $productData['imagePath'] = '/assets/Images/' . $imageName;
        $productData['myCategoryCode'] = $categoryDTO->getCode();
        $productData['idProductIdHidden'] = $productDTO->getId();

        $response->setContent(ViewRenderer::render('views/snippets/admin/products/EditProductView', $productData));

        return $response;
    }

    /**
     * Method used to edit product
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editProduct(Request $request): Response
    {
        if (!ProductValidator::validateProduct($request->getQuery()['sku'], $request->getQuery()['title'],
            $request->getQuery()['brand'], $request->getQuery()['price'], $request->getQuery()['shortDescription'],
            $request->getQuery()['description'])) {
            return new JSONResponse(['message' => ProductValidator::getErrorMessage()]);
        }

        $productCategory = CategoryService::getCategoryByCode($request->getQuery()['category']);
        $productDTO = new Product($productCategory->getId(), $request->getQuery()['sku'], $request->getQuery()['title'],
            $request->getQuery()['brand'], $request->getQuery()['price'], $request->getQuery()['shortDescription'],
            $request->getQuery()['description'], ' ', $request->getQuery()['enabled'], $request->getQuery()['featured'],
            0);
        $productDTO->setId($request->getQuery()['idProduct']);
        ProductService::editProduct($productDTO);

        return new JSONResponse(['message' => 'Product edited.']);
    }

}