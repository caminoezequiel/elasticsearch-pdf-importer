<?php

namespace CE\Elastic\Importer;

use CE\Elastic\Model\Document;

interface ImporterInterface
{
    /**
     * @param Document $document
     * @return string
     */
    public function import(Document $document);
}
