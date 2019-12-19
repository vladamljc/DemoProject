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
     * @var array
     */
    private $data;

    /**
     * JSONResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Returns JSON content of Response.
     *
     * @return string
     */
    public function getContent(): string
    {
        return json_encode($this->data);
    }
}