<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Request;
use Catalog\Http\Response;
use Catalog\Services\CategoryService;
use Catalog\Services\ProductService;
use Catalog\Services\StatisticsService;
use Catalog\Utility\ViewRenderer;

/**
 * Class HomeController
 *
 * @package Catalog\Controllers
 */
class HomeController extends FrontController
{

    /**
     * Method that returns featured products on main visitor page.
     *
     * @return Response
     */
    public function renderHomePage(): Response
    {

        StatisticsService::incrementHomepageCount();

        $htmlResponse = new HTMLResponse();

        $productsData = array();

        $featuredProducts = ProductService::getFeaturedProducts();
        $numProducts = count($featuredProducts);

        $numRows = ceil($numProducts / 3);
        $productsData['numRows'] = $numRows;
        $productsData['featuredProducts'] = $featuredProducts;
        $productsData['numProducts'] = $numProducts;

        $htmlResponse->setContent(ViewRenderer::render('views/visitor/HomePage', $productsData));

        return $htmlResponse;
    }

    /**
     * This method returns all products that belong to clicked category from navigation menu.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function returnSelectedCategory(Request $request): Response
    {
        $response = new HTMLResponse();

        $categoryCode = $request->getQuery()['code'];
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

        $response->setContent(ViewRenderer::render('views/visitor/VisitorCategoryPage',
            $products));

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