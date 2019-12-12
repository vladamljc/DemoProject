<?php

namespace Catalog\Utility;

/**
 * Class ViewRenderer
 *
 * @package Catalog\Utility
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

        include __DIR__ . '/../resources/' . $view . '.php';

        return ob_get_clean();
    }

}