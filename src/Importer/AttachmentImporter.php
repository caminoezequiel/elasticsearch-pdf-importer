<?php

namespace CE\Elastic\Importer;

use CE\Elastic\Importer\Reader\ReaderInterface;
use CE\Elastic\Model\Document;
use CE\Elastic\Pipeline\Attachment;
use Elasticsearch\Client;

/**
 * Class BinaryImporter
 *
 * @package CE\Elastic\Importer
 */
class AttachmentImporter implements ImporterInterface
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var ReaderInterface
     */
    private $reader;

    /**
     * BinaryImporter constructor.
     *
     * @param Client $client
     * @param ReaderInterface $reader
     */
    public function __construct(Client $client, ReaderInterface $reader)
    {
        $this->client = $client;
        $this->reader = $reader;
    }

    /**
     * @param Document $document
     * @return string
     */
    public function import(Document $document)
    {
        $index = $document->getIndex();
        $file = $this->reader->read($document->getFile());
        $params = [
            'index' => $index->getIndex(),
            'type' => $index->getType(),
            'id' => $index->getId(),
            'pipeline' => Attachment::getName(),
            'body' => [
                Attachment::getField() => base64_encode($file),
            ]
        ];
        foreach ($document->getFields() as $name => $value) {
            $params['body'][$name] = $value;
        }
        $response = $this->client->index($params);
        return $response['_id'];
    }
}
