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

        for ($i = 2; $i < $n; $i++) 
        {
            $fibm += $fibm1;
            $fibm1 = $fibm;
            $fibm2 = $fibm1;
        }

        return $fibm2;
    }    
}