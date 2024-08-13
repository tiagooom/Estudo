<?php

require_once('Solution.php');
require_once('arrayGenerator.php');

$array = new ArrayGenerator();

$arr = $array->genArray();
$arr = [1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 611, 612];
$find = 612;
sort($arr);

echo 'Para o array: <br>';
foreach ($arr as $value) echo $value . ' ';
echo '<br><br>';

$solution = new Solution();

$posicao = $solution->jumpSort($arr, $find);

if ($posicao !== NULL) echo 'A chave ' . $find . ' está na posição ' . $posicao;
    else echo 'A chave ' . $find . ' não está no array.';