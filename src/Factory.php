<?php

namespace Eze\Elastic;

use Elasticsearch\ClientBuilder;

/**
 * Class Factory
 *
 * @package Eze\Elastic
 */
class Factory
{
    /**
     * @param string $host
     * @return \Elasticsearch\Client
     */
    public static function getClient($host)
    {
        return ClientBuilder::create()->setHosts([$host])->build();
    }

}
