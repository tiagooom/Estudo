<?php 

class Solution {

    function linearSearch($arr, $key) {        

        foreach($arr as $position => $value)
        {
            if ($value == $key) return 'O número está na posição ' . $position . ' do array.';
        }

        return 'Elemento não encontrado';
    }
}