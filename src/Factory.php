<?php

namespace CE\Elastic;

use Elasticsearch\ClientBuilder;

/**
 * Class Factory
 *
 * @package CE\Elastic
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
