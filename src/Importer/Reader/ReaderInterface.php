<?php

namespace Eze\Elastic\Importer\Reader;


interface ReaderInterface
{
    /**
     * @param string $path
     * @return mixed
     */
    public function read(string $path);

}
