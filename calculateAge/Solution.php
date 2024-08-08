<?php

class Solution
{
    public function age($birth, $current)
    {
        $meses = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; 

        $bcArray = explode('/', $birth);
        $cdArray = explode('/', $current);

        $bcArray = array_map('intval', $bcArray);
        $cdArray = array_map('intval', $cdArray);

        for ($i = 0; $i <= 2; $i++)
        {
            if ($cdArray[$i] < $bcArray[$i])
            {
                if ($i == 0)
                {
                $resposta[$i] = $cdArray[$i]-$bcArray[$i]+$meses[$bcArray[$i+1]-1];
                $bcArray[$i+1]++;
                }
                elseif ($i == 1)
                {
                    $resposta[$i] = $cdArray[$i]-$bcArray[$i]+12;
                    $bcArray[$i+1]++;
                }
            }else 
            {
                $resposta[$i] = $cdArray[$i]-$bcArray[$i];
            }
        }
        return $resposta;
    }
}