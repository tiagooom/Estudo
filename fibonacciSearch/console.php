<?php

require __DIR__ . '/vendor/autoload.php';

use App\Command\FibonacciSearchCommand;
use Symfony\Component\Console\Application;
use App\Command\GreetCommand;
use App\FibonacciSearcher;

    $array = [10, 20, 30, 40, 50, 60, 70];
    $find = 10;

    $fibonacci = new FibonacciSearcher();

    $teste = $fibonacci->fibSearch($array, $find);
    echo '<pre>';
    var_dump($teste);
    echo '<pre>';
    
$application = new Application();

// Registre o comando
$application->add(new GreetCommand());
$application->add(new FibonacciSearchCommand());

$application->run();
var_dump('teste');
