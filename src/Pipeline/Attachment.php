<?php

namespace CE\Elastic\Pipeline;

use Elasticsearch\Client;

/**
 * Class Attachment
 *
 * @package CE\Elastic\Pipeline
 */
class Attachment implements PipelineInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * PipelineCreator constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public static function getName()
    {
        return 'attachment';
    }

    /**
     * @inheritdoc
     */
    public static function getField()
    {
        return 'data';
    }

    /**
     * @inheritdoc
     */
    public function create()
    {
        $params = [
            'id' => static::getName(),
            'body' => [
                'description' => 'Extract attachment information',
                'processors' => [
                    [
                        'attachment' => [
                            'field' => static::getField(),
                            'indexed_chars' => -1
                        ]
                    ]
                ]
            ],
        ];
        $response = $this->client->ingest()->putPipeline($params);
        return $response['acknowledged'];
    }

    /**
     * @return bool
     */
    public function exists()
    {
        try {
            $this->client->ingest()->getPipeline(['id' => static::getName()]);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
