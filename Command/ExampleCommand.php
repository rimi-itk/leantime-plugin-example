<?php

namespace Leantime\Plugins\Example\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Example command.
 */
#[AsCommand(
    name: 'example:test',
    description: 'Example command',
)]
final class ExampleCommand extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(sprintf('This is the %s command.', $this->getName()));

        return static::SUCCESS;
    }
}
