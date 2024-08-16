<?php

require __DIR__.'/vendor/autoload.php';
require_once('solution.php');

$entrada = [1, 2, 4, 6, 3, 7, 8];
$n = 8;

$solution = new Solution();

$resposta = $solution->missingNumber($entrada, $n);

echo 'Para o array: ';

foreach ($entrada as $value)
{
    echo $value . ' ';
}

echo '<br>';



