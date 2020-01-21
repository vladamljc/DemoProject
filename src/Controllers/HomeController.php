<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Response;
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

    /**Stub method for rendering index page
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
}