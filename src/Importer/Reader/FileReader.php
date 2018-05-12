<?php

namespace CE\Elastic\Importer\Reader;

/**
 * Class FileReader
 *
 * @package CE\Elastic\Importer\Reader
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
}
