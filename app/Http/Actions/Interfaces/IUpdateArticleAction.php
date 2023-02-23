<?php

namespace App\Http\Actions\Interfaces;

use App\Models\Article;

interface IUpdateArticleAction
{
    public function execute(Article $article, string $title, string $content, array $authors): Article;
}
