<?php

class Solution
{
    public function missingNumber($arr, $n)
    {
        $resp = NULL;

        sort($arr);

        for ($i = 0; $i < $n; $i++)
        {
            if ($arr[$i] != ($i+1)) {
                return $i+1;
            }
        }

        return $resp;
    }
}