<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GreetCommand extends Command
{
    protected static $defaultName = 'app:greet';

    protected function configure()
    {
        $this
            ->setDescription('Greet someone.')
            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        if ($name) {
            $greeting = 'Hello, ' . $name . '!';
        } else {
            $greeting = 'Hello!';
        }

        $output->writeln($greeting);

        return Command::SUCCESS;
    }
}
