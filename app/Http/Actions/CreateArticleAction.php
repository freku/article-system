<?php

namespace App\Http\Actions;

use App\Http\Actions\Interfaces\ICreateArticleAction;
use App\Models\Article;

class CreateArticleAction implements ICreateArticleAction
{
    public function execute(string $title, string $content, array $authors): Article
    {
        $article = new Article();

        $article->title = $title;
        $article->content = $content;

        $article->save();
        $article->authors()->sync($authors);

        return $article;
    }
}
