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
        $categoryData = [
            'pages.site.activities.*' => $categoryService->getByActive(1),
            'pages.site.category' => $categoryService->getByActive(1),
            'pages.site.home' => $categoryService->getByActive(1),
            'pages.site.personal' => $categoryService->getByActive(1),
            'pages.site.post' => $categoryService->getByActive(1),
            'pages.site.reset-password' => $categoryService->getByActive(1),
            'pages.site.trending' => $categoryService->getByActive(1),
            'pages.site.my-posts.index' => $categoryService->getAll(),
            'pages.site.my-posts.create' => $categoryService->getByActive(1),
            'pages.site.my-posts.edit' => $categoryService->getByActive(1),
            'pages.admin.posts.create'   => $categoryService->getByActive(1),
            'pages.admin.posts.edit'     => $categoryService->getByActive(1),
            'pages.admin.posts.index'    => $categoryService->getAll(),
        ];

        foreach ($categoryData as $view => $categories) {
            view()->composer($view, function ($view) use ($categories) {
                $view->with(['listCategories' => $categories]);
            });
        }
    }
}
