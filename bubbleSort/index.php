<?php
require_once('Solution.php');

$numero = '';
$array = array(6, 0, 3, 5);

echo "Para o array <br>";
foreach($array as $value)
{
    echo $value. " ";
}

$solution = new Solution();

$array = $solution->bubbleSort($array);
echo "<br><br>Ele ordenado ficará<br>";
foreach($array as $value)
{
    echo $value. " ";
}