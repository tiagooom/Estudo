<?php

//Problem: Queries to find the future closest date
require_once('Solution.php');

$entrada = ["22/4/1233", "1/3/633", "23/5/56645", "4/12/233"];
$q = 2;
$query = ["23/3/4345", "12/3/2"];

$solution = new Solution();

$resposta = $solution->closestDate($entrada, $q, $query);

var_dump($resposta);