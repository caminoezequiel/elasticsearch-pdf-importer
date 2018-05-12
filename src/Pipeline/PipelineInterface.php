<?php

namespace CE\Elastic\Pipeline;


interface PipelineInterface
{
    /**
     * @return string
     */
    public static function getName();

    /**
     * @return string
     */
    public static function getField();

    /**
     * @return bool
     */
    public function create();

    /**
     * @return bool
     */
    public function exists();
}
