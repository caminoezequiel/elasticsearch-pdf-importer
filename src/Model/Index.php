<?php

namespace CE\Elastic\Model;

/**
 * Class Index
 *
 * @package CE\Elastic\Model
 */
class Index
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $index;

    /**
     * Node constructor.
     *
     * @param string $index
     * @param string $type
     * @param string $id
     */
    public function __construct(string $index, string $type, string $id = null)
    {
        $this->id = $id;
        $this->type = $type;
        $this->index = $index;
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return Index
     */
    public function setId($id): Index
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Index
     */
    public function setType(string $type): Index
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param string $index
     * @return Index
     */
    public function setIndex(string $index): Index
    {
        $this->index = $index;
        return $this;
    }

    /**
     * Generates a hash id composed by index, type and given plainId
     *
     * @param string $plainId
     * @return string
     */
    public function generateId($plainId)
    {
        $this->id = hash('md5', "{$this->index}_{$this->type}_{$plainId}");
        return $this->id;
    }
}
