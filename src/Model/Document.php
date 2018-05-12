<?php

namespace Eze\Elastic\Model;

/**
 * Class Document
 *
 * @package Eze\Elastic\Model
 */
class Document
{
    /**
     * @var Index
     */
    private $index;
    /**
     * @var string
     */
    private $file;
    /**
     * @var array
     */
    private $fields;

    /**
     * Document constructor.
     * @param Index $index
     */
    public function __construct(Index $index = null)
    {
        $this->index = $index;
    }

    /**
     * @return Index
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param Index $index
     * @return Document
     */
    public function setIndex(Index $index)
    {
        $this->index = $index;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return Document
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return Document
     */
    public function addField(string $name, $value)
    {
        $this->fields[$name] = $value;
        return $this;
    }
}
