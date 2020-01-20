<?php

namespace Catalog\Utility;

/**
 * Class SelectCategoryBean
 *
 * @package Catalog\Utility
 */
class SelectCategoryBean
{
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $parentTitle;

    /**
     * SelectCategoryBean constructor.
     *
     * @param string $title
     * @param string $code
     * @param string $parentTitle
     */
    public function __construct(string $title, string $code, string $parentTitle)
    {
        $this->title = $title;
        $this->code = $code;
        $this->parentTitle = $parentTitle;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCategoryText(): string
    {
        return $this->categoryText;
    }

    /**
     * @param string $categoryText
     */
    public function setCategoryText(string $categoryText): void
    {
        $this->parentTitle = $categoryText;
    }

}