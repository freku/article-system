<?php

namespace App\Http\Actions\Interfaces;

use App\Models\Article;

interface ICreateArticleAction
{
    public function execute(string $title, string $content, array $authors): Article;
}
