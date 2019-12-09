<?php

namespace Catalog\Views;

/**
 * Class ViewRender
 *
 * @package Catalog\Views
 */
class ViewRender
{
    /**
     * @var string
     */
    private static $view;
    /**
     * @var array
     */
    private static $data;

    /**
     * Renders view as a string.
     *
     * @param string $view
     * @param array $data
     *
     * @return string
     */
    public static function render(string $view, array $data = null): string
    {
        ob_start();
        include __DIR__ . '/../Views/' . $view;

        return ob_get_clean();
    }

    /**
     * @return string
     */
    public static function getView(): string
    {
        return self::$view;
    }

    /**
     * @param string $view
     */
    public static function setView(string $view): void
    {
        self::$view = $view;
    }

    /**
     * @return array
     */
    public static function getData(): array
    {
        return self::$data;
    }

    /**
     * @param array $data
     */
    public static function setData(array $data): void
    {
        self::$data = $data;
    }

}