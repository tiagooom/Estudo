<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria; // Mudança: Categoria ao invés de Category

class Artigo extends Model
{
    use HasFactory;

    // Campos em português
    protected $fillable = ['titulo', 'corpo', 'publicado_em', 'categoria_id'];

    // Relação com a Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class); // Um artigo pertence a uma categoria
    }

    // Relação com os Comentários
    public function comentarios()
    {
        return $this->hasMany(Comentario::class); // Um artigo possui vários comentários
    }
}
