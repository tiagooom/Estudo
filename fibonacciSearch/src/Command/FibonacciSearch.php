<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FibonacciSearch extends Command
{
    protected function configure()
{
    $this
        ->setName('app:fibonacci-search')
        ->setDescription('Faz uma busca usando fibonacci')
        ->addArgument('find', InputArgument::REQUIRED, 'Número a ser achado.');
}

}