<?php

use Eze\Elastic\Factory;
use Eze\Elastic\Pipeline\Attachment;

require __DIR__ . '/../vendor/autoload.php';

try {
    $client = (new Factory())->getClient('localhost:9200');
    $pipeline = new Attachment($client);
    if ($pipeline->exists()) {
        echo 'Attachment pipeline already exists';
        exit;
    }
    $pipeline->create();
    echo 'Attachment pipeline created!';
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage(), $e->getTraceAsString();
}
