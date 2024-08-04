<?php

class Solution
{
    public function minSum($arr)
    {
        $arr2 = []; 
        while (count($arr) > 1) {
            for ($i = 0; $i < count($arr) - 1; $i += 2) {
                if ($arr[$i] > $arr[$i + 1])
                {
                    $arr2[] = $arr[$i + 1]; 
                    unset($arr[$i + 1]); 
                }else 
                {
                    $arr2[] = $arr[$i]; 
                    unset($arr[$i]); 
                } 
            }
            $arr = array_values($arr);
        }
        return array_sum($arr2); 
    }
}