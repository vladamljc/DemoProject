<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Response;
use Catalog\Views\ViewRenderer;

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
        $response->setContent(ViewRenderer::render('AdminProductPage', array()));

        return $response;
    }
}