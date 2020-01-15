<?php

namespace Catalog\Data\DTO;

class Product
{
    /**
     * @var int
     */
    private $categoryId;
    /**
     * @var string
     */
    private $sku;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $brand;
    /**
     * @var int
     */
    private $price;
    /**
     * @var string
     */
    private $shortDescription;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $image;
    /**
     * @var int
     */
    private $enabled;
    /**
     * @var int
     */
    private $featured;
    /**
     * @var int
     */
    private $viewCount;

    /**
     * @var string
     */
    private $categoryName;

    /**
     * Product constructor.
     *
     * @param int $categoryId
     * @param string $sku
     * @param string $title
     * @param string $brand
     * @param int $price
     * @param string $shortDescription
     * @param string $description
     * @param string $image
     * @param int $enabled
     * @param int $featured
     * @param int $viewCount
     */
    public function __construct(
        int $categoryId,
        string $sku,
        string $title,
        string $brand,
        int $price,
        string $shortDescription,
        string $description,
        string $image = '',
        int $enabled,
        int $featured,
        int $viewCount = 0
    ) {
        $this->categoryId = $categoryId;
        $this->sku = $sku;
        $this->title = $title;
        $this->brand = $brand;
        $this->price = $price;
        $this->shortDescription = $shortDescription;
        $this->description = $description;
        $this->image = $image;
        $this->enabled = $enabled;
        $this->featured = $featured;
        $this->viewCount = $viewCount;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
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
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getEnabled(): int
    {
        return $this->enabled;
    }

    /**
     * @return int
     */
    public function getFeatured(): int
    {
        return $this->featured;
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     */
    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

}