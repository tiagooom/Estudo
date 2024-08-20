<?php

require __DIR__ . '/vendor/autoload.php';

use App\Command\FibonacciSearch;
use Symfony\Component\Console\Application;
use App\Command\GreetCommand;

$application = new Application();

// Registre o comando
$application->add(new GreetCommand());
$application->add(new FibonacciSearch());

$application->run();
