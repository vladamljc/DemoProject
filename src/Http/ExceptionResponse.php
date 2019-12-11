<?php

namespace Catalog\Http;

/**
 * Class ExceptionResponse
 *
 * @package Catalog\Http
 */
class ExceptionResponse extends Response
{

    /**
     * ExceptionResponse constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return '';
    }
}