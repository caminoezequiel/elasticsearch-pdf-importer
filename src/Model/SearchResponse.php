<?php

namespace Eze\Elastic\Model;

/**
 * Class SearchResponse
 *
 * @package Eze\Elastic\Model
 */
class SearchResponse
{
    /**
     * @var int
     */
    private $total;
    /**
     * @var float
     */
    private $score;
    /**
     * @var Result[]
     */
    private $results;

    /**
     * SearchResponse constructor.
     */
    public function __construct()
    {
        $this->total = 0;
        $this->score = 0;
        $this->results = array();
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     * @return SearchResponse
     */
    public function setTotal(int $total): SearchResponse
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param float $score
     * @return SearchResponse
     */
    public function setScore(float $score): SearchResponse
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return Result[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param Result[] $results
     * @return SearchResponse
     */
    public function setResults(array $results): SearchResponse
    {
        $this->results = $results;
        return $this;
    }

    public function addResult(Result $item)
    {
        $this->results[] = $item;
    }
}
