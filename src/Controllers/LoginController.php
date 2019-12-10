<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Response;
use Catalog\Views\ViewRenderer;

/**
 * Class LoginController
 *
 * @package Catalog\Controllers
 */
class LoginController extends FrontController
{

    /**
     * Returns response for login action
     *
     * @return Response
     */
    public function renderLoginForm(): Response
    {
        $response = new HTMLResponse();

        $response->setContent(ViewRenderer::render('AdminLoginPage', array()));

        return $response;
    }

}