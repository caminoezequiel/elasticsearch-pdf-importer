<?php

namespace Eze\Elastic\Importer;

use Eze\Elastic\Model\Document;

interface ImporterInterface
{
    /**
     * @param Document $document
     * @return string
     */
    public function import(Document $document);
}
