<?php

namespace Catalog\Views;

/**
 * Class ViewRenderer
 *
 * @package Catalog\Views
 */
class ViewRenderer
{

    /**
     * Renders view as a string.
     *
     * @param string $view
     * @param array $data
     *
     * @return string
     */
    public static function render(string $view, array $data = []): string
    {
        ob_start();

        if (!empty($data)) {
            extract($data, EXTR_OVERWRITE);
        }

        include __DIR__ . '/../Views/' . $view . '.php';

        return ob_get_clean();
    }

}