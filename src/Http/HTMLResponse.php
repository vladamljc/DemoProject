<?php

namespace Catalog\Http;

/**
 * Class HTMLResponse
 *
 * @package Catalog\Http
 */
class HTMLResponse extends Response
{
    /**
     * @var string
     */
    private $stringHTML;

    /**
     * HTMLResponse constructor.
     *
     * @param string $stringHTML
     */
    public function __construct(string $stringHTML = '')
    {
        $this->stringHTML = $stringHTML;
    }

    /**
     * Getting string content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->stringHTML;
    }

    /**
     * Setting content by string.
     *
     * @param string $stringHTML
     */
    public function setContent(string $stringHTML): void
    {
        $this->stringHTML = $stringHTML;
    }
}