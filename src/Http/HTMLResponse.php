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
        parent::__construct();
        $this->stringHTML = $stringHTML;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->stringHTML;
    }

    /**
     * @param string $stringHTML
     */
    public function setContent(string $stringHTML)
    {
        $this->stringHTML = $stringHTML;
    }
}