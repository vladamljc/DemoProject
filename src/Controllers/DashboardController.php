<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Response;
use Catalog\Views\ViewRender;

/**
 * Class DashboardController
 *
 * @package Catalog\Controllers
 */
class DashboardController extends AdminController
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**Generates view for admin dashboard page and returns it within response.
     *
     * @return Response
     */
    public function getDashBoardView(): Response
    {
        $response = new HTMLResponse();
        $response->setContent(ViewRender::render('AdminDashboardPage.php', null));

        return $response;
    }
}