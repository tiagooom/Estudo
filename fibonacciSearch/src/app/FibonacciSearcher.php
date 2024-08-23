<?php

namespace App;

class FibonacciSearcher
{
    public function fibSearch($arr, $find)
    {
        $fibm2 = 0;
        $fibm1 = 1;
        $fibm = $fibm1 + $fibm2;
        $n = count($arr);
        $fib = [$fibm2, $fibm1, $fibm];

        for ($i = 2; $i < $n; $i++) 
        {
            $fibm2 = $fibm1;
            $fibm1 = $fibm;
            $fibm = $fibm1 + $fibm2;
            $fib[] = $fibm;
        }

        return $fib;
    }    
}