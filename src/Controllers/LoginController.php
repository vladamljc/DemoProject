<?php

namespace Catalog\Controllers;

use Catalog\Data\Models\Admin;
use Catalog\Http\HTMLResponse;
use Catalog\Http\Response;
use Catalog\Services\LoginService;
use Catalog\Utility\ViewRenderer;

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

        $response->setContent(ViewRenderer::render('views/admin/AdminLoginPage'));

        return $response;
    }

    public function loginAction(): Response
    {
        $username = $_POST['user'];
        $password = $_POST['pass'];

        /**
         * @var Admin $admin
         */
        $admin = LoginService::login($username, $password);
        if ($admin !== null) {
            $redirect = new DashboardController();

            return $redirect->index();
        }

        if ($admin === null) {
            session_unset();
            session_destroy();
            $cookieName = 'cookieAdmin';
            setcookie($cookieName, '', time() - 3600);

            return $this->renderLoginForm();
        }
    }

}