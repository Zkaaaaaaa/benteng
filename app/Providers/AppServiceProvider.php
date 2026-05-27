<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.client.app', function ($view) {
            $view->with('menuCategories', Category::query()
                ->with(['products' => fn ($q) => $q->active()->ordered()])
                ->whereHas('products', fn ($q) => $q->active())
                ->ordered()
                ->get());
        });
    }
}
