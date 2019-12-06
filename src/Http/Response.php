<?php

namespace Catalog\Http;

/**
 * Class Response
 *
 * @package Catalog\Http
 */
abstract class Response
{

    /**
     * Response constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return string to be redefined in classes that extend Response class
     */
    abstract public function getContent(): string;

}