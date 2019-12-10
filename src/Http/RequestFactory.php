<?php

namespace Catalog\Http;

/**
 * Class RequestFactory
 *
 * @package Catalog\Http
 */
class RequestFactory
{

    /**
     * @return Request
     */
    public static function makeNewRequest(): Request
    {
        $request = new Request();

        $request->setBody(file_get_contents('php://input'));

        $request->setHeaders(HeaderLoader::getallheaders());

        $queryArray = self::getQueryParameters();
        $request->setQuery($queryArray);

        $uri = self::getUri();
        $request->setUri($uri);

        $request->setMethod($_SERVER['REQUEST_METHOD']);

        return $request;
    }

    /**
     * Returns query parameters from uri.
     *
     * @return array
     */
    protected static function getQueryParameters(): array
    {
        $queryString = $_SERVER['QUERY_STRING'];
        $queryArray = array();
        parse_str($queryString, $queryArray);

        return $queryArray;
    }

    /**
     * Returns uri string.
     *
     * @return string
     */
    protected static function getUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');

        return $uri;
    }

}