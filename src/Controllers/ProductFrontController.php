<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Request;
use Catalog\Http\Response;
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

        $response->setContent(ViewRenderer::render('views/visitor/ProductDisplay',
            [ProductService::getProductBySKU($request->getParameters()[0])]));

        return $response;
    }

}