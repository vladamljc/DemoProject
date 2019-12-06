<?php

namespace Catalog\Http;

/**
 * Class JSONResponse
 *
 * @package Catalog\Http
 */
class JSONResponse extends Response
{
    /**
     * @return string
     */
    public function getContent(): string
    {
        return 'dummy response';
    }
}