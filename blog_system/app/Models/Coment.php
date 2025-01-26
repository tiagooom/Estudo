<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class); // Um comentário pertence a um artigo
    }
}
