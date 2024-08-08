<?php

//Problem: Given the current date and birth date, find the present age. 
require_once('Solution.php');

$birthDate = '07/09/1996';
$presentDate = '07/12/2017';

$solution = new Solution();

$resposta = $solution->age($birthDate, $presentDate);


echo 'For the birth date: ' . $birthDate . ' and the present date: ' . $presentDate. '<br>';
echo 'Present Age = Years: '.$resposta[2].' Months: ' . $resposta[1] . ' Days: '.$resposta[0];

//var_dump($resposta);