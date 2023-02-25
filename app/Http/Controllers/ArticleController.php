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
        $article = $this->articleRepository->getArticleById($articleId);

        if (!$article) {
            return response()->json([
                'error' => 'Article with that id does not exist.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'data' => $article,
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
