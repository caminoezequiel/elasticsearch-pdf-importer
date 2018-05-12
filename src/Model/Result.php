<?php

namespace Eze\Elastic\Model;

/**
 * Class Result
 *
 * @package Eze\Elastic\Model
 */
class Result
{
    /**
     * @var Index
     */
    private $index;
    /**
     * @var float
     */
    private $score;
    /**
     * @var array
     */
    private $source;
    /**
     * @var array
     */
    private $highlight;

    /**
     * @return Index
     */
    public function getIndex(): Index
    {
        return $this->index;
    }

    /**
     * @param Index $index
     * @return Result
     */
    public function setIndex(Index $index): Result
    {
        $this->index = $index;
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
     * @return Result
     */
    public function setScore(float $score): Result
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return array
     */
    public function getSource(): array
    {
        return $this->source;
    }

    /**
     * @param array $source
     * @return Result
     */
    public function setSource(array $source): Result
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return array
     */
    public function getHighlight(): array
    {
        return $this->highlight;
    }

    /**
     * @param array $highlight
     * @return Result
     */
    public function setHighlight(array $highlight): Result
    {
        $this->highlight = $highlight;
        return $this;
    }

}
