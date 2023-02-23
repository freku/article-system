<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Article;
use Illuminate\Support\Collection;

interface IArticleRepository
{
    public function getArticlesByAuthorId(int $id): Collection;

    public function getArticleById(int $id): ?Article;

    public function getAll(): Collection;
}
