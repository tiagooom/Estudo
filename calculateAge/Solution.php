<?php

class Solution
{
    public function age($birth, $current)
    {

        $bcArray = explode('/', $birth);
        $cdArray = explode('/', $current);

        $bcArray = array_map('intval', $bcArray);
        $cdArray = array_map('intval', $cdArray);

        for ($i = 0; $i <= 2; $i++)
        {
            if ($cdArray[$i] > $bcArray[$i])
            {

            }else $resposta[$i] = $cdArray[$i]-$bcArray[$i];
        }

        var_dump($bcArray);
        //var_dump((int)$bdFormated->format('Y'));
    }
}