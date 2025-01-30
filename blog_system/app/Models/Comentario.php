<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    // Definindo os campos que podem ser preenchidos
    protected $fillable = ['conteudo', 'artigo_id', 'user_id'];

    // Relação com o Artigo
    public function artigo()
    {
        return $this->belongsTo(Artigo::class); // Um comentário pertence a um artigo
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Um comentário pertence a um artigo
    }
    
}
