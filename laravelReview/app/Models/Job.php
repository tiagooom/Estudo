<?php

namespace App\Models;

use \Illuminate\Support\Arr;

class Job {
    public static function all() : array
    {
        return [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '$50,000'
            ],
            [
                'id' => 2,
                'title' => 'Teacher',
                'salary' => '$40,000'
            ],
            [
                'id' => 3,
                'title' => 'Teste',
                'salary' => '$10,000'
            ]
        ];
    }

    public static function find($id)
    {
        $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);
        
        if (!$job) {
            abort('404');
        }
        return $job;
    }
}