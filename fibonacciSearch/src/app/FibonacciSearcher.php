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

        for ($i = 2; $i < $n; $i++) // achando 3 ultimos numeros do fibonacci para busca
        {
            $fibm2 = $fibm1;
            $fibm1 = $fibm;
            $fibm = $fibm1 + $fibm2;

        }

        $offset = -1; //incializando offset para formula

        while ($fibm > 1){

            $posicao = min($offset + $fibm2, $n-1); // fomula para a posicao de busca

            if ($arr[$posicao] == $find) {
                return $posicao;
            } elseif ($arr[$posicao] < $find) { //se for menor vai pra uma posicao anterior
                $fibm = $fibm1;
                $fibm1 = $fibm2;
                $fibm2 = $fibm - $fibm1;
                $offset = $posicao;
            } else {                            //se for maior pra duas posicoes anteriores
                $fibm = $fibm2;
                $fibm1 = $fibm1 - $fibm2; 
                $fibm2 = $fibm - $fibm1;
            }
        }

        if ($fibm1 && $arr[$offset + 1] == $find) { //testando ultimo numero do array
            return $offset + 1;
        }
        return -1;
    }    
}