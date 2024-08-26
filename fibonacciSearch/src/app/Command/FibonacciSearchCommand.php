<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\FibonacciSearcher;

class FibonacciSearchCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:fibonacci-search')
            ->setDescription('Faz uma busca usando fibonacci')
            ->addArgument('find', InputArgument::REQUIRED, 'Número a ser achado.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $array = [2, 3, 7, 15, 18, 21, 30, 35];

        $find = $input->getArgument('find');

        $fibonacci = new FibonacciSearcher();

        $find = $fibonacci->fibSearch($array, $find);
        
        $output->writeln($find);

        return Command::SUCCESS;
    }

}