<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Request;
use Catalog\Http\Response;
use Catalog\Services\CategoryService;
use Catalog\Services\ProductService;
use Catalog\Utility\ViewRenderer;

/**
 * Class ProductFrontController
 *
 * @package Catalog\Controllers
 */
class ProductFrontController extends FrontController
{

    /**
     * Returns details about clicked product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $response = new HTMLResponse();

        $product = ProductService::getProductBySKU($request->getParameters()[1]);

        if ($product === null) {
            $response->setContent('Product does not exist');

            return $response;
        }

        $response->setContent(ViewRenderer::render('views/visitor/SelectedProductInformation',
            [$product]));

        $product->setViewCount($product->getViewCount() + 1);

        ProductService::incrementViewCount($product);

        return $response;
    }

    /**
     * Method that returns products to show to visitor.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function renderProducts(Request $request): Response
    {

        $response = new HTMLResponse();

        $categoryCode = $request->getParameters()[1];
        $category = CategoryService::getCategoryByCode($categoryCode);
        $categoryId = $category->getId();

        $sortBy = $request->getQuery()['sortBy'];
        $productsPerPage = $request->getQuery()['pageOffset'];

        $sorting = $this->decodeSortingCode($sortBy);

        $pageNumber = $request->getQuery()['page'];
        $paginationOffset = ($pageNumber - 1) * $productsPerPage;

        if (CategoryService::getChildrenCount($categoryId) === 0) {
            $productArray = ProductService::getProductsById($categoryId, $sorting['column'], $sorting['method'],
                $productsPerPage, $paginationOffset);
            $products['countProducts'] = ProductService::getProductsNumberById($categoryId, $sorting['column'],
                $sorting['method']);
        } else {
            $categoryHierarchy = CategoryService::getChildrenIds($categoryId);
            $productArray = ProductService::getProductsByIds($categoryHierarchy, $sorting['column'],
                $sorting['method'], $productsPerPage, $paginationOffset);
            $products['countProducts'] = ProductService::getProductsNumberByIds($categoryHierarchy, $sorting['column'],
                $sorting['method']);
        }

        $products['numProducts'] = count($productArray);
        $products['numRows'] = ceil($products['numProducts'] / 5);
        $products['products'] = $productArray;
        $products['numPages'] = ceil($products['countProducts'] / $productsPerPage);
        $products['categoryCode'] = $categoryCode;
        $products['currentPageNumber'] = $pageNumber;

        ($request->getQuery()['caller'] === '0') ? $response->setContent(ViewRenderer::render('views/visitor/ProductsDisplay',
            $products)) : $response->setContent(ViewRenderer::render('views/visitor/DisplayArea', $products));

        return $response;
    }

    /**
     * Decode input parameter and returns array that contains column and sort filter.
     *
     * @param string $sortBy
     *
     * @return array
     */
    private function decodeSortingCode(string $sortBy): array
    {

        $columnName = '';
        $sortMethod = '';

        switch ($sortBy) {
            case 'pa':
            {
                $columnName = 'Price';
                $sortMethod = 'ascending';
                break;
            }
            case 'pd':
            {
                $columnName = 'Price';
                $sortMethod = 'descending';
                break;
            }

            case 'ta':
            {
                $columnName = 'Title';
                $sortMethod = 'ascending';
                break;
            }

            case 'td':
            {
                $columnName = 'Title';
                $sortMethod = 'descending';
                break;
            }

            case 'ba':
            {
                $columnName = 'Brand';
                $sortMethod = 'ascending';
                break;
            }

            case 'bd':
            {
                $columnName = 'Brand';
                $sortMethod = 'descending';
                break;
            }
        }

        return ['column' => $columnName, 'method' => $sortMethod];
    }

}