<?php

class Solution
{
    
    public function exibirArray($nums)
    {
        echo 'Para o array: ';
        foreach($nums as $value)
        {
            echo $value. ' ';
        }
        echo '<br>';
    }

    public function binarySearch($nums, $find)
    {

        $min = 0;
        $max = count($nums) - 1;
        $apontador =  (int)(($min + $max) / 2);

        while ($find != $nums[$apontador]) {
            
            if ($find > $nums[$apontador]) {
                $min = $apontador + 1;
            } else {
                $max = $apontador - 1;
            }
            $apontador =  (int)(($min + $max) / 2);
            if ($min > $max) return "Não encontrado.";
        }
        return $apontador;
    }
}