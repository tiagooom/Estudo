<?php

require __DIR__ . '/vendor/autoload.php';

use App\Command\FibonacciSearchCommand;
use Symfony\Component\Console\Application;
use App\Command\GreetCommand;
use App\FibonacciSearcher;

    $array = [1, 3, 7, 15, 18, 21, 30, 35];
    $find = 30;

    $fibonacci = new FibonacciSearcher();

    $teste = $fibonacci->fibSearch($array, $find);
    
$application = new Application();

// Registre o comando
$application->add(new GreetCommand());
$application->add(new FibonacciSearchCommand());

$application->run();
