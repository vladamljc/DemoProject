<?php

namespace Catalog\Controllers;

/**
 * Class ErrorHandler
 *
 * @package Catalog\Controllers
 */
class ErrorHandler
{
    /**
     * Depending on error code, this functions handles error differently
     *
     * @param int $errorCode
     */
    public function handleError(int $errorCode)
    {
        switch ($errorCode) {
            case 404:
            {
                http_response_code(404);
                exit;
            }
            case 500:
            {

            }
        }
    }
}