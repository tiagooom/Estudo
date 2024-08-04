<?php

//Problem: Minimum sum by choosing minimum of pairs from array
require_once('Solution.php');

$numero = '';
$array = array(2, 2, 2, 2);
$array = array(3, 2, 3, 4, 1);
//$array = array(3, 4);

echo "Para o array <br>";
foreach($array as $value)
{
    echo $value. " ";
}

$solution = new Solution();

$resposta = $solution->minSum($array);

echo "<br><br>Resposta<br>";
echo "A soma dos elementos do array resultante é: ".$resposta;

