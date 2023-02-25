<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\IArticleRepository;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ArticleRepository implements IArticleRepository
{
    public function __construct(private Article $model)
    {
    }

    public function getArticlesByAuthorId(int $id): Collection
    {
        return $this->model
            ->with('authors')
            ->whereHas('authors', function (Builder $query) use ($id) {
                $query->where('author_id', $id);
            })
            ->get();
    }

    public function getArticleById(int $id): ?Article
    {
        return $this->model
            ->with('authors')
            ->find($id);
    }

    public function getAll(): Collection
    {
        return $this->model
            ->with('authors')
            ->get();
    }
}
