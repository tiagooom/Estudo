<?php

class Solution{
    
    public function jumpSort($array, $find)
    {
        $tam = count($array);
        $jumps = (int) sqrt($tam);

        $position = NULL;
        $i = $jumps-1;
        
        while (!$position && ($i < $tam))
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

        if ((fmod(sqrt($tam), 1)) != 0){ //Se o tamamnho do array nao for um numero inteiro

            $inicio = $i - ($jumps-1);

            for ($i = $inicio ; $i < $tam; $i++)
            {
                if ($array[$i] == $find)
                {
                    $position = $i;
                    return $position;
                } 
            }
            
        }
        return $position;
    }
}