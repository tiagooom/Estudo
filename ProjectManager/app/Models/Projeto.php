<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'projeto_user');
    }

    public function tarefas()
    {
        return $this->belongsToMany(Tarefa::class);
    }
}
