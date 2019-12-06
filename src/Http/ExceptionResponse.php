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
     * @var string
     */
    private $error_message;

    /**
     * ExceptionResponse constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->error_message = 'ERROR 404 ROUTE NOT FOUND';

        http_response_code(404);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->error_message;
    }
}