<?php

namespace App\Http\Controllers;

use App\Http\Actions\Interfaces\ICreateArticleAction;
use App\Http\Actions\Interfaces\IUpdateArticleAction;
use App\Http\Repositories\Interfaces\IArticleRepository;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class ArticleController extends BaseController
{
    public function __construct(
        private IArticleRepository $articleRepository,
        private ICreateArticleAction $createArticleAction,
        private IUpdateArticleAction $updateArticleAction
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->articleRepository->getAll(),
        ]);
    }

    public function show(int $articleId): JsonResponse
    {
        return response()->json([
            'data' => $this->articleRepository->getArticleById($articleId),
        ]);
    }

    public function create(ArticleRequest $request): JsonResponse
    {
        return response()->json(
            $this->createArticleAction->execute(
                $request->title,
                $request->content,
                $request->authors
            ),
            Response::HTTP_CREATED
        );
    }

    public function update(ArticleRequest $request, Article $article): JsonResponse
    {
        return response()->json(
            $this->updateArticleAction->execute(
                $article,
                $request->title,
                $request->content,
                $request->authors
            ),
            Response::HTTP_OK
        );
    }
}
