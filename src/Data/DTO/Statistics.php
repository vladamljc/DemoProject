<?php

namespace Catalog\Data\DTO;

/**
 * Class Statistics
 *
 * @package Catalog\Data\DTO
 */
class Statistics
{
    /**
     * @var int
     */
    private $Id;

    /**
     * @var int
     */
    private $HomeViewCount;

    public function __construct(int $Id, int $HomeViewCount)
    {
        $this->Id = $Id;
        $this->HomeViewCount = $HomeViewCount;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->Id;
    }

    /**
     * @param int $Id
     */
    public function setId(int $Id): void
    {
        $this->Id = $Id;
    }

    /**
     * @return int
     */
    public function getHomeViewCount(): int
    {
        return $this->HomeViewCount;
    }

    /**
     * @param int $HomeViewCount
     */
    public function setHomeViewCount(int $HomeViewCount): void
    {
        $this->HomeViewCount = $HomeViewCount;
    }

}