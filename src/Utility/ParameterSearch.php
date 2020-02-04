<?php

namespace Catalog\Utility;

/**
 * Class ParameterSearch
 *
 * @package Catalog\Utility
 */
class ParameterSearch
{
    /**
     * @var string
     */
    public $keyword;
    /**
     * @var array
     */
    public $categoryInfo;
    /**
     * @var float
     */
    public $minPrice;
    /**
     * @var float
     */
    public $maxPrice;
    /**
     * @var float
     */
    public $limit;
    /**
     * @var float
     */
    public $offset;

    /**
     * @var string
     */
    public $searchType;

    /**
     * ParameterSearch constructor.
     *
     * @param string $keyword
     * @param array $categoryInfo
     * @param float $minPrice
     * @param float $maxPrice
     * @param int $limit
     * @param int $offset
     * @param string $searchType
     */
    public function __construct(
        string $keyword,
        array $categoryInfo,
        float $minPrice,
        float $maxPrice,
        int $limit,
        int $offset,
        string $searchType
    ) {
        $this->keyword = $keyword;
        $this->categoryInfo = $categoryInfo;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->searchType = $searchType;
    }
}