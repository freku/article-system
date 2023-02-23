<?php

namespace App\Http\Actions;

use App\Http\Actions\Interfaces\IUpdateArticleAction;
use App\Models\Article;

class UpdateArticleAction implements IUpdateArticleAction
{
    public function execute(Article $article, string $title, string $content, array $authors): Article
    {
        $article->title = $title;
        $article->content = $content;
        $article->save();

        $article->authors()->sync($authors);

        return $article;
    }
}
