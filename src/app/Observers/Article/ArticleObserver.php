<?php

namespace App\Observers\Article;

use App\Models\Article\Article;

class ArticleObserver
{
    public function creating(Article $article): void
    {
        $article->user_id = auth()->id();
    }

    public function updating(Article $article): void
    {
        $article->user_id = auth()->id();
    }
}
