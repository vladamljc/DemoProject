<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Request;
use Catalog\Http\Response;
use Catalog\Services\LoginService;
use Catalog\Utility\CookieManagement;
use Catalog\Utility\Session;
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

    public function loginAction(Request $request): Response
    {
        $username = $request->getPost()['user'];
        $password = $request->getPost()['pass'];
        $keepLogged = $request->getPost()['checkboxLoggedIn'];
        $flagMakeCookie = false;

        if (isset($keepLogged)) {
            $flagMakeCookie = true;
        } else {
            $flagMakeCookie = false;
        }

        $logInSuccessful = LoginService::login($username, $password, $flagMakeCookie);
        if ($logInSuccessful === true) {
            $redirect = new DashboardController();

            return $redirect->index();
        }

        if ($logInSuccessful === false) {

            Session::endSession();
            CookieManagement::removeCookie('cookieAdmin');

            return $this->renderLoginForm();
        }
    }

}