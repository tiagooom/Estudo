<?php

require __DIR__ . '/vendor/autoload.php';

use App\Command\FibonacciSearchCommand;
use Symfony\Component\Console\Application;
use App\Command\GreetCommand;
use App\FibonacciSearcher;
    
$application = new Application();

// Registre o comando
$application->add(new GreetCommand());
$application->add(new FibonacciSearchCommand());

$application->run();
