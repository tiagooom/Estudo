<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }
    

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
