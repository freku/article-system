<?php

namespace App\Providers;

use App\Http\Actions\CreateArticleAction;
use App\Http\Actions\Interfaces\ICreateArticleAction;
use App\Http\Actions\Interfaces\IUpdateArticleAction;
use App\Http\Actions\UpdateArticleAction;
use App\Http\Repositories\ArticleRepository;
use App\Http\Repositories\AuthorRepository;
use App\Http\Repositories\Interfaces\IArticleRepository;
use App\Http\Repositories\Interfaces\IAuthorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(IArticleRepository::class, ArticleRepository::class);
        $this->app->bind(IAuthorRepository::class, AuthorRepository::class);

        // Actions
        $this->app->bind(ICreateArticleAction::class, CreateArticleAction::class);
        $this->app->bind(IUpdateArticleAction::class, UpdateArticleAction::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
