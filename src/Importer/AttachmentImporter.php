<?php

namespace Eze\Elastic\Importer;

use Eze\Elastic\Importer\Reader\ReaderResolver;
use Eze\Elastic\Model\Document;
use Eze\Elastic\Pipeline\Attachment;
use Elasticsearch\Client;

/**
 * Class BinaryImporter
 *
 * @package Eze\Elastic\Importer
 */
class AttachmentImporter implements ImporterInterface
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var ReaderResolver
     */
    private $readerResolver;

    /**
     * BinaryImporter constructor.
     *
     * @param Client $client
     * @param ReaderResolver $readerResolver
     */
    public function __construct(Client $client, ReaderResolver $readerResolver)
    {
        $this->client = $client;
        $this->readerResolver = $readerResolver;
    }

    /**
     * @param Document $document
     * @return string
     */
    public function import(Document $document)
    {
        $data = $this->readerResolver->resolve($document->getFile())->read($document->getFile());
        $index = $document->getIndex();
        $params = [
            'index' => $index->getIndex(),
            'type' => $index->getType(),
            'id' => $index->getId(),
            'pipeline' => Attachment::getName(),
            'body' => [
                Attachment::getField() => base64_encode($data),
            ]
        ];
        foreach ($document->getFields() as $name => $value) {
            $params['body'][$name] = $value;
        }
        $response = $this->client->index($params);
        return $response['_id'];
    }
}
