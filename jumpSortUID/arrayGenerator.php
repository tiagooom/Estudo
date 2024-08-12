<?php

require 'vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class ArrayGenerator
{
    public function genArray()
    {
        for ($i=0; $i<9; $i++) {
            $uuid = Uuid::uuid4();
            $array[] = $uuid->toString();
        }
        
        return $array;
    }
}