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
     */
    public function __construct(string $controller, string $action, string $uri, string $method)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->uri = $uri;
        $this->method = $method;
        $this->middlewareList = array();
        //echo 'route constructed<br>';
    }

    /**
     * @param string $newMiddleware
     */
    public function addMiddleware(string $newMiddleware): void
    {
        echo 'new middleware added...<br>';
        $this->middlewareList[] = $newMiddleware;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getMiddlewareList(): array
    {
        return $this->middlewareList;
    }

    /**
     * @param array $middlewareList
     */
    public function setMiddlewareList(array $middlewareList): void
    {
        $this->middlewareList = $middlewareList;
    }
}
