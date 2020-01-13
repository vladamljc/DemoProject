<?php

namespace Catalog\Data\Beans;

/**
 * Class CategoryBean
 *
 * @package Catalog\Data
 */
class CategoryBean
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $title;

    /**
     * @var int
     */
    public $parentId;

    /**
     * @var string
     */
    public $code;

    /**
     * CategoryBean constructor.
     *
     * @param int $id
     * @param string $title
     * @param int $parentId
     * @param string $code
     */
    public function __construct(int $id, string $title, int $parentId, string $code = '')
    {
        $this->title = $title;
        $this->id = $id;
        $this->parentId = $parentId;
        $this->code = $code;
    }

}