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
        // Use list categories
        $views = ['pages.site.*', 'pages.admin.posts.*'];
        foreach ($views as $view) {
            view()->composer($view, function ($view) use ($categoryService) {
                $view->with([
                    'listCategories' => $categoryService->getAll()
                ]);
            });
        }
    }
}
