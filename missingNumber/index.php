<?php

require __DIR__.'/vendor/autoload.php';
require_once('solution.php');

$solution = new Solution();

$entrada = [1, 2, 4, 6, 3, 7, 8];

echo 'Para o array: ';

foreach ($entrada as $value)
{
    echo $value . ' ';
}

echo '<br>';

