<?php

namespace Eze\Elastic\Importer\Reader;

/**
 * Class FileReader
 *
 * @package Eze\Elastic\Importer\Reader
 */
class FileReader implements ReaderInterface
{
    /**
     * @param string $path
     * @return mixed
     */
    public function read(string $path)
    {
        $path = realpath($path);
        if (!$path || !file_exists($path)) {
            throw new \InvalidArgumentException('File given is invalid');
        }
        if (!is_readable($path)) {
            throw new \InvalidArgumentException('Invalid permissions on file to read');
        }
        return fread(fopen($path, 'r'), filesize($path));
    }

    /**
     * @param mixed $uri
     * @return boolean
     */
    public function supports($uri)
    {
        $file = realpath($uri);
        return (file_exists($file) && is_readable($file));
    }
}
