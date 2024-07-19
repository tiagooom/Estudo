<?php

require_once('solution.php');

$solution = new Solution();

$entrada = [5,4,3,2,1];

echo 'Para o array: ';

foreach ($entrada as $value)
{
    echo $value . ' ';
}

echo "\nDigite o número a ser achado: ";
$find = readline();

echo $solution->linearSearch($entrada, $find);