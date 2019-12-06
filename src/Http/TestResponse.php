<?php

namespace Catalog\Http;

/**
 * Class TestResponse
 *
 * @package Catalog\Http
 */
class TestResponse extends Response
{
    /**
     * @var string
     */
    private $text;

    /**
     * TestResponse constructor.
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        parent::__construct();
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->text;
    }
}