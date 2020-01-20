<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Response;
use Catalog\Services\StatisticsService;
use Catalog\Utility\ViewRenderer;

/**
 * Class DashboardController
 *
 * @package Catalog\Controllers
 */
class DashboardController extends AdminController
{

    /**
     * Generates view for admin dashboard page and returns it within response.
     *
     * @return Response
     */
    public function index(): Response
    {
        $response = new HTMLResponse();

        $dashboardData = array();
        $dashboardData['numProducts'] = StatisticsService::getProductsCount();
        $dashboardData['numCategories'] = StatisticsService::getCategoriesCount();
        $dashboardData['openingCount'] = StatisticsService::getHomeViewCount();

        $productDTO = StatisticsService::getMostViewedProduct();

        $dashboardData['mostViewedProductName'] = $productDTO->getTitle();
        $dashboardData['mostViewedProductViewCount'] = $productDTO->getViewCount();

        $response->setContent(ViewRenderer::render('views/admin/AdminDashboardPage', $dashboardData));

        return $response;
    }
}