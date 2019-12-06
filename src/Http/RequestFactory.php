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

        //$request->setBody();
        $request->setHeaders(getallheaders());

        $queryString = $_SERVER['QUERY_STRING'];
        $queryArray = array();
        parse_str($queryString, $queryArray);
        $request->setQuery($queryArray);

        $request->setMethod($_SERVER['REQUEST_METHOD']);

        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');
        $request->setUri($uri);

        return $request;
    }
}