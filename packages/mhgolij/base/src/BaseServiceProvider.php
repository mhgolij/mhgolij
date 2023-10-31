<?php
namespace mhgolij\base;
use Illuminate\Support\Facades\Route;
use mhgolij\base\http\Livewire\UsersGroup\Users;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use mhgolij\base\http\Middleware\MhgolijBaseIsAdminMiddleware;

class BaseServiceProvider extends ServiceProvider
{
    public function boot(\Illuminate\Routing\Router $router) : void
    {
        $router->aliasMiddleware('is_admin',MhgolijBaseIsAdminMiddleware::class);
        Route::middleware('web')->group(function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/route.php');
        });
        Route::middleware('api')->prefix('api')->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mhgolijBase');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mhgolijBase');
        $this->bootLivewires();
    }
    public function bootLivewires() : void {
        Livewire::component('users', Users::class);
    }
    public function bootPublished() : void {
        $this->publishes([__DIR__.'/../public/fonts/'=> public_path("/../resources/assets/fonts")],'mhgolijBaseFonts');
        $this->publishes([__DIR__.'/../public/css/'=> public_path("/assets/css")],'mhgolijBaseCss');
        $this->publishes([__DIR__.'/../public/js/'=> public_path("/assets/js")],'mhgolijBaseJs');
        $this->publishes([__DIR__.'/../database/seeders'=> "database/seeders"],'mhgolijBaseSeeders');
    }
}
