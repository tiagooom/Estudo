<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'published_at', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class); // Um artigo pertence a uma categoria
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); // Um artigo possui vários comentários
    }
}
