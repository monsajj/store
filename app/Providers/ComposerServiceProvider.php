<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Http\ViewComposers\CartComposer;
use App\Http\ViewComposers\CategoriesComposer;
use App\Http\ViewComposers\LocalesComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'layouts.front.app',
                'front.categories.sidebar-category',
                'layouts.front.category-nav'
            ],
            CategoriesComposer::class);

        View::composer(
            'layouts.front.app',
            CartComposer::class);

        View::composer(
            'layouts.front.app',
            LocalesComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
