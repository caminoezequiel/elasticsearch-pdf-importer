<?php

namespace Eze\Elastic\Importer\Reader;


class UrlReader implements ReaderInterface
{
    /**
     * @inheritdoc
     */
    public function read(string $path)
    {
        $path = filter_var($path, FILTER_SANITIZE_URL);
        $headers = get_headers($path);
        if (strpos($headers[0], '200 OK') === false && strpos($headers[0], '302 Found') === false) {
            throw new \InvalidArgumentException('Url given does not exist');
        }
        return file_get_contents($path, false, stream_context_create(
            array(
                'http' => array(
                    'follow_location' => true
                )
            )
        ));
    }

    /**
     * @inheritdoc
     */
    public function supports($uri)
    {
        return filter_var($uri, FILTER_VALIDATE_URL);
    }
}
