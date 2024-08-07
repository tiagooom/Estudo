<?php

//Problem: Given the current date and birth date, find the present age. 
require_once('Solution.php');

$birthDate = '07/09/1996';
$birthDate = '10/10/2017';
$presentDate = '11/11/2017';

$solution = new Solution();

$resposta = $solution->age($birthDate, $presentDate);

var_dump($resposta);