<?php

namespace Catalog\Controllers;

use Catalog\Data\Beans\SearchCategoryBean;
use Catalog\Http\HTMLResponse;
use Catalog\Http\Request;
use Catalog\Http\Response;
use Catalog\Services\CategoryService;
use Catalog\Services\ProductService;
use Catalog\Utility\ParameterSearch;
use Catalog\Utility\ViewRenderer;

/**
 * Class ProductSearchController
 *
 * @package Catalog\Controllers
 */
class ProductSearchController extends FrontController
{
    public function index(Request $request): Response
    {
        $response = new HTMLResponse();

        $categoriesInfo = array();

        $categoriesDTO = CategoryService::getAllCategories();

        foreach ($categoriesDTO as $categoryDTO) {
            $parentId = $categoryDTO->getParentId();
            if ($parentId === -1) {
                $parentTitle = 'Root';
            } else {
                $parentCategory = CategoryService::getCategoryById($parentId);
                $parentTitle = $parentCategory->getTitle();
            }
            $bean = new SearchCategoryBean($categoryDTO->getCode(), $categoryDTO->getTitle(), $parentTitle);
            $categoriesInfo[] = $bean;
        }

        $numCategoriesBean = count($categoriesInfo);

        $minPrice = !isset($request->getQuery()['minPrice']) ? '' : (float)$request->getQuery()['minPrice'];
        $maxPrice = !isset($request->getQuery()['maxPrice']) ? '' : (float)$request->getQuery()['maxPrice'];

        $renderingInformation = array(
            'categories' => $categoriesInfo,
            'numCategoriesBean' => $numCategoriesBean,
            'keyword' => $request->getQuery()['keyword'],
            'numPages' => 1,
            'currentPageNumber' => 1,
            'min' => $minPrice,
            'max' => $maxPrice
        );

        (isset($request->getQuery()['selectCategory'])) ? ($renderingInformation['selectCategory'] = ($request->getQuery()['selectCategory'])) : ($renderingInformation['selectCategory'] = 'any');

        $response->setContent(ViewRenderer::render('views/visitor/SearchPage', $renderingInformation));

        return $response;
    }

    /**
     * Renders page for search criteria.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getPage(Request $request): Response
    {
        $response = new HTMLResponse();

        $filterCategoryCode = $request->getQuery()['selectedCategory'];
        $paginationOffset = ($request->getQuery()['page'] - 1) * $request->getQuery()['productsPerPage'];
        $searchType = $request->getQuery()['searchType'];

        $minPrice = (float)$request->getQuery()['minPrice'];
        $maxPrice = (float)$request->getQuery()['maxPrice'];

        if ($maxPrice !== null) {
            if (!is_numeric($maxPrice)) {
                $response->setContent('ERROR: Max price must be a number.');

                return $response;
            }
        }

        if ($minPrice !== null) {
            if (!is_numeric($minPrice)) {
                $response->setContent('ERROR: Min price must be a number.');

                return $response;
            }
        }

        if ($minPrice !== null && $maxPrice !== null) {
            if ($minPrice > $maxPrice) {
                $response->setContent('ERROR: Max value must be higher than min value.');

                return $response;
            }
        }

        $searchParam = new ParameterSearch(
            $request->getQuery()['keyword'],
            ['code' => $filterCategoryCode],
            (float)$request->getQuery()['minPrice'],
            (float)$request->getQuery()['maxPrice'],
            $request->getQuery()['productsPerPage'],
            $paginationOffset, $searchType);

        $products = ProductService::searchProducts($searchParam);

        $searchParam->categoryInfo['code'] = $filterCategoryCode;
        $countProducts = ProductService::countNumberProducts($searchParam);

        $numRows = ceil(count($products) / 5);
        $numProducts = count($products);

        $numPages = ceil($countProducts / $request->getQuery()['productsPerPage']);

        $renderingInformation = array(
            'products' => $products,
            'productsTotal' => $countProducts,
            'numRows' => $numRows,
            'numProducts' => $numProducts,
            'keyword' => $request->getQuery()['keyword'],
            'numPages' => $numPages,
            'currentPageNumber' => $request->getQuery()['page']
        );

        $response->setContent(ViewRenderer::render('views/visitor/DisplaySearchedProducts', $renderingInformation));

        return $response;
    }

}