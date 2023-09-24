<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Language;

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
    public function boot(): void
    {
        $views = ['pages.site.home', 'pages.site.post'];

        foreach ($views as $view) {
            view()->composer($view, function ($view) {
                $view->with([
                    'listLanguages' => Language::all()
                ]);
            });
        }
    }
}
