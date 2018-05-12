<?php

namespace App\Command;

use Eze\Elastic\Factory;
use Eze\Elastic\Pipeline\Attachment;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetupCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('elasticsearch:setup')
            ->setDescription('Installs the Attachment Processor in a Pipeline.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $client = (new Factory())->getClient('localhost:9200');
            $pipeline = new Attachment($client);
            if ($pipeline->exists()) {
                $output->writeln("Attachment pipeline already exists");
                return;
            }
            $pipeline->create();
            $output->writeln("Attachment pipeline created!");
        } catch (\Exception $e) {
            $output->writeln('Exception: ' . $e->getMessage());
        }
    }

}
