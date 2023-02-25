<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Interfaces\IArticleRepository;
use App\Http\Repositories\Interfaces\IAuthorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class AuthorController extends BaseController
{
    public function __construct(
        private IAuthorRepository $authorRepository,
        private IArticleRepository $articleRepository,
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->authorRepository->getAll(),
        ]);
    }

    public function getAllAuthorsArticles(int $authorId): JsonResponse
    {
        return response()->json([
            'data' => $this->articleRepository->getArticlesByAuthorId($authorId),
        ]);
    }

    public function getTopAuthors(): JsonResponse
    {
        return response()->json([
            'data' => $this->authorRepository->getTopAuthorsThatWroteTheMostInTheLastWeek(3),
        ]);
    }
}
