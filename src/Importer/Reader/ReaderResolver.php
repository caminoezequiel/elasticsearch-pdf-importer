<?php

namespace Eze\Elastic\Importer\Reader;

class ReaderResolver
{
    /**
     * @var ReaderInterface[]
     */
    private $readers;

    /**
     * ReaderResolver constructor.
     *
     * @param ReaderInterface[] $readers
     */
    public function __construct(array $readers)
    {
        foreach ($readers as $reader) {
            $this->addReader($reader);
        }
    }

    /**
     * Resolves a reader for the uri given
     *
     * @param mixed $uri
     * @return ReaderInterface
     */
    public function resolve($uri)
    {
        foreach ($this->readers as $reader) {
            if ($reader->supports($uri)) {
                return $reader;
            }
        }
        return null;
    }

    /**
     * @param ReaderInterface $reader
     */
    public function addReader(ReaderInterface $reader)
    {
        $this->readers[] = $reader;
    }
}
