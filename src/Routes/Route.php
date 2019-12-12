<?php

namespace Catalog\Routes;

/**
 * Class Route
 *
 * @package Catalog\Routes
 */
class Route
{
    /**
     * @var string
     */
    private $controller;
    /**
     * @var string
     */
    private $action;
    /**
     * @var string
     */
    private $uri;
    /**
     * @var string
     */
    private $method;
    /**
     * @var array
     */
    private $middlewareList;

    /**
     * Route constructor.
     *
     * @param string $controller
     * @param string $action
     * @param string $uri
     * @param string $method
     * @param array $middlewareList
     */
    public function __construct(
        string $controller,
        string $action,
        string $uri,
        string $method,
        array $middlewareList = []
    ) {
        $this->controller = $controller;
        $this->action = $action;
        $this->uri = $uri;
        $this->method = $method;
        $this->middlewareList = $middlewareList;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getMiddlewareList(): array
    {
        return $this->middlewareList;
    }

}
