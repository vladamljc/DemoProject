<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Response;
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
}