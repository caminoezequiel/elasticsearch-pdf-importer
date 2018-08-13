<?php

namespace Eze\Elastic\Importer\Reader;


interface ReaderInterface
{
    /**
     * @param string $path
     * @return mixed
     */
    public function read(string $path);

    /**
     * @param mixed $uri
     * @return boolean
     */
    public function supports($uri);

}
