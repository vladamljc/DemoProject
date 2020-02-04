<?php

namespace Catalog\Data\Beans;

/**
 * Class SearchCategoryBean
 *
 * @package Catalog\Data\Beans
 */
class SearchCategoryBean
{
    /**
     * @var string
     */
    public $code;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $parentTitle;

    /**
     * SearchCategoryBean constructor.
     *
     * @param string $code
     * @param string $title
     * @param string $parentTitle
     */
    public function __construct(string $code, string $title, string $parentTitle)
    {
        $this->code = $code;
        $this->title = $title;
        $this->parentTitle = $parentTitle;
    }
}