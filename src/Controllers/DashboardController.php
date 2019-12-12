<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Response;
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
        $response->setContent(ViewRenderer::render('views/admin/AdminDashboardPage'));
        return $response;
    }
}