<?php

namespace App\Providers;

use App\Services\ConfigUploader\ConfigUploaderInterface;
use App\Services\ConfigUploader\LaravelConfigUploader;
use App\Services\Container\Container;
use App\Services\Container\ContainerInterface;
use App\Services\Searcher\Contracts\SearcherInterface;
use App\Services\Searcher\ProductSearcher;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConfigUploaderInterface::class, LaravelConfigUploader::class);

        $this->app->bind(ContainerInterface::class, Container::class);

        $this->app->bind(CacheInterface::class, Cache::class);

        $this->app->bind(SearcherInterface::class, ProductSearcherProxy::class);

        $this->app->bind(SessionInterface::class, Session::class);
    }
}

