<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $repositories = [
            'Brand\BrandRepositoryInterface' => 'Brand\BrandRepository',
            'Size\SizeRepositoryInterface' => 'Size\SizeRepository',
            'Type\TypeRepositoryInterface' => 'Type\TypeRepository',
            'Color\ColorRepositoryInterface' => 'Color\ColorRepository',
            'Product\ProductRepositoryInterface' => 'Product\ProductRepository',
            'Picture\ImageRepositoryInterface' => 'Picture\ImageRepository',
        ];
        foreach ($repositories as $key => $val) {
            $this->app->bind("App\\Repositories\\$key", "App\\Repositories\\$val");
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
