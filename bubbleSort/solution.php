<?php

class Solution
{
    public function bubbleSort($arr)
    {
        $tam = count($arr);
        $change = true;
        
        while ($change)
        {
            $change = false;
            for($i=0; $i<($tam-1); $i++)
            {
                if($arr[$i] > $arr[$i+1])
                {
                    
                    /*$temp = $arr[$i];
                    $arr[$i] = $arr[$i+1];
                    $arr[$i+1] = $temp;   */
                    
                    [$arr[$i], $arr[$i+1]] = [$arr[$i+1], $arr[$i]];
                    $change = true;            
                }
            }
            $tam--;
        }               
        return $arr;
    }
}