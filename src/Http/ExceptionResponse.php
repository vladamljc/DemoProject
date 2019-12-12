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
     * @var string $errorMessage
     */
    private $errorMessage;

    /**
     * ExceptionResponse constructor.
     *
     * @param string $errorMessage
     */
    public function __construct(string $errorMessage)
    {
        parent::__construct();
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->errorMessage;
    }
}