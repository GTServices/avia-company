<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\CompanyInfo;
use App\Repositories\LanguageRepository;

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
        // View-lərə verilərin ötürülməsi
        View::composer('*', function ($view) {
            $companyInfo = CompanyInfo::first();

            // LanguageRepository-i konteynerdən əldə edirik
            $languageRepository = app(LanguageRepository::class);
            $languages = $languageRepository->all('order', 'asc');

            $view->with('companyInfo', $companyInfo)
                ->with('languages', $languages);
        });
    }
}
