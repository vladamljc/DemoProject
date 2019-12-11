<?php

namespace Catalog\Controllers;

use Catalog\Http\Response;

/**
 * Class ErrorHandler
 *
 * @package Catalog\Controllers
 */
class ErrorHandler extends FrontController
{
    /**
     * Depending on error code, this functions handles error differently
     *
     * @param int $errorCode
     *
     * @return Response
     */
    public function handleError(int $errorCode): Response
    {
        switch ($errorCode) {
            case 404:
            {
                http_response_code(404);
            }
            case 500:
            {

            }
        }
    }
}