<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\IAuthorRepository;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AuthorRepository implements IAuthorRepository
{
    public function __construct(private Author $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model
            ->get();
    }

    public function getTopAuthorsThatWroteTheMostInTheLastWeek(int $limit): Collection
    {
        return $this->model
            ->withCount(['articles' => function ($query) {
                $query->whereBetween('articles.created_at', [Carbon::now()->subWeek(), Carbon::now()]);
            }])
            ->orderBy('articles_count', 'desc')
            ->limit($limit)
            ->get();
    }
}
