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

        for ($i = 3; $i < $n; $i++) 
        {
            $fibm2 = $fibm1;
            $fibm1 = $fibm;
            $fibm = $fibm1 + $fibm2;

        }

        $offset = -1;

        for ($j =0; $j < 5; $j++){

            $posicao = min($offset + $fibm2, $n-1);

            if ($arr[$posicao] == $find) {
                return $posicao;
            } elseif ($arr[$posicao] < $find) {
                $fibm = $fibm1;
                $fibm1 = $fibm2;
                $fibm2 = $fibm - $fibm1;
                $offset = $posicao;
            } else {
                $fibm = $fibm2;
                $fibm1 = $fibm1 - $fibm;
                $fibm2 = $fibm - $fibm1;
            }
        }
        return $posicao;
    }    
}