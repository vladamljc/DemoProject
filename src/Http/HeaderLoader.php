<?php

namespace Catalog\Http;

/**
 * Class HeaderLoader
 *
 * @package Catalog\Http
 */
class HeaderLoader
{

    /**
     * Returns array of request headers.
     *
     * @return array
     */
    public static function getallheaders(): array
    {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (strpos($name, 'HTTP_') == 0) {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $headers;
    }

}