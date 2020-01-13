<?php

namespace Catalog\Data\DTO;

/**
 * Class Category
 *
 * @package Catalog\Data\DTO
 */
class Category
{
    /**
     * @var int
     */
    private $parentId;
    /**
     * @var string
     */
    private $code;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $id;

    /**
     * Category constructor.
     *
     * @param int $parentId
     * @param string $code
     * @param string $title
     * @param string $description
     * @param int $id
     */
    public function __construct(int $parentId, string $code, string $title, string $description, int $id = 0)
    {
        $this->parentId = $parentId;
        $this->code = $code;
        $this->title = $title;
        $this->description = $description;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}