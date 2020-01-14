<?php

namespace Catalog\Data\Beans;

/**
 * Class EditCategoryBean
 *
 * @package Catalog\Data\Beans
 */
class EditCategoryBean
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
     * @var
     */
    public $id;

    /**
     * EditCategoryBean constructor.
     *
     * @param string $code
     * @param string $title
     * @param int $id
     */
    public function __construct(string $code, string $title, int $id)
    {
        $this->code = $code;
        $this->title = $title;
        $this->id = $id;
    }

}