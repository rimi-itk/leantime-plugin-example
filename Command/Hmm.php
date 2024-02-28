<?php

namespace Leantime\Plugins\Itk\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'itk:hmm',
    description: 'Does stuff',
)]
class Hmm extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int {
        $output->writeln(__METHOD__);

        return Command::SUCCESS;
    }
}
