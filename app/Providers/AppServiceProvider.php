<?php

namespace App\Providers;

use App\Enums\Category\CategoryStatus;
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
        $views = [
            'pages.site.activities.*',
            'pages.site.category',
            'pages.site.home',
            'pages.site.personal',
            'pages.site.post',
            'pages.site.reset-password',
            'pages.site.trending',
            'pages.site.my-posts.create',
            'pages.site.my-posts.edit',
            'pages.site.profile',
            'pages.admin.posts.create',
            'pages.admin.posts.edit'
        ];
        foreach ($views as $view) {
            view()->composer($view, function ($view) use ($categoryService) {
                $view->with([
                    'listCategories' => $categoryService->getByStatus(CategoryStatus::PUBLIC)
                ]);
            });
        }

        $views = [
            'pages.site.my-posts.index',
            'pages.admin.posts.index',
        ];
        foreach ($views as $view) {
            view()->composer($view, function ($view) use ($categoryService) {
                $view->with([
                    'listCategories' => $categoryService->getAll()
                ]);
            });
        }
    }
}
