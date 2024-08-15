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
            //var_dump("b1413b31-aefb-40bb-a858-46057c068c45" < "e5f88bb1-8ced-407b-b15e-d9c55de6f8a6");
            
            if ($find <= $array[$i])
            {
                $inicio = max(0, $i - $jumps);
                $fim = $inicio + $jumps;
                var_dump($inicio);
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