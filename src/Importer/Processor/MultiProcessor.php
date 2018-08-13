<?php

namespace Eze\Elastic\Importer\Processor;


class MultiProcessor implements ProcessorInterface
{
    /**
     * @var ProcessorInterface[]
     */
    private $processors;

    /**
     * MultiProcessor constructor.
     * @param ProcessorInterface[] $processors
     */
    public function __construct(array $processors)
    {
        foreach ($this->processors as $processor) {
            $this->addProcessor($processor);
        }
    }

    /**
     * @param mixed $data by reference reduce memory use
     * @return mixed
     */
    public function process(&$data)
    {
        foreach ($this->processors as $processor) {
            $data = $processor->process($data);
        }
        return $data;
    }

    /**
     * @param ProcessorInterface $processor
     */
    public function addProcessor(ProcessorInterface $processor)
    {
        $this->processors[] = $processor;

    }
}
