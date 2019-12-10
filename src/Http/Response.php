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
     * Returns content from Response(usually string).
     *
     * @return string to be redefined in classes that extend Response class
     */
    abstract public function getContent(): string;

}