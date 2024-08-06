<?php

class Solution
{
    public function closestDate($arr, $q, $queries)
    {
        
        foreach ($queries as $dateq)
        {
            $closest = -1;
            $formateddateq = DateTime::createFromFormat('d/m/Y', $dateq);
            foreach ($arr as $datea)
            {
                $formateddatea = DateTime::createFromFormat('d/m/Y', $datea);
                if ($formateddatea > $formateddateq) 
                {
                    $intervalo = $formateddateq->diff($formateddatea)->days;
                    if ($closest == -1) 
                    {
                        $closest = $intervalo;
                        $closestDate = $formateddatea->format('d/m/Y');
                    
                    }
                    elseif ($intervalo < $closest)
                    {
                        $closest = $intervalo;
                        $closestDate =$formateddatea->format('d/m/Y');
                    } 
                }
               //echo $dateq.' '.$datea.' = '.$intervalo.'<br>'; compara datas
            }
            $closestDates[] = ($closest != -1) ? $closestDate : -1;
        }
        return $closestDates;
    }
}