<?php

class Solution{
    
    public function jumpSort($array, $find)
    {
        $jumps = (int) sqrt(count($array));

        $position = NULL;
        $i = $jumps-1;
        
        while (!$position && ($i < count($array)))
        {
            if ($find <= $array[$i])
            {
                $inicio = $i - ($jumps-1);
                $fim = $inicio + $jumps;

                for ($i = $inicio ; $i < $fim; $i++)
                {
                    if ($array[$i] == $find)
                    {
                        $position = $i;
                        return $position;
                    } 
                }
                break;
            }
            $i += 4;
        }
        return $position;
    }
}