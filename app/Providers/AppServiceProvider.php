<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Site\CategoryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(CategoryService $categoryService): void
    {
        $views = ['pages.site.*', 'pages.admin.posts.create', 'pages.admin.posts.edit'];
        foreach ($views as $view) {
            view()->composer($view, function ($view) use ($categoryService) {
                $view->with([
                    'listCategories' => $categoryService->getByActive(true)
                ]);
            });
        }

        $views = ['pages.admin.posts.index'];
        foreach ($views as $view) {
            view()->composer($view, function ($view) use ($categoryService) {
                $view->with([
                    'listCategories' => $categoryService->getAll()
                ]);
            });
        }
    }
}
