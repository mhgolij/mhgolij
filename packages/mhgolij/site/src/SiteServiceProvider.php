<?php
namespace mhgolij\site;

use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{
    public function boot(\Illuminate\Routing\Router $router) : void
    {
//        $router->aliasMiddleware('is_admin',MhgolijBaseIsAdminMiddleware::class);
        $this->loadRoutesFrom(__DIR__.'/../routes/route.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mhgolijSite');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mhgolijSite');
//        $this->bootLivewires();
    }
//    public function bootLivewires() : void {
//        Livewire::component('users', Users::class);
//    }
    public function bootPublished() : void {
        $this->publishes([__DIR__.'/../public/fonts/'=> public_path("/../resources/assets/fonts")],'mhgolijSiteFonts');
        $this->publishes([__DIR__.'/../public/css/'=> public_path("/assets/css")],'mhgolijSiteCss');
        $this->publishes([__DIR__.'/../public/js/'=> public_path("/assets/js")],'mhgolijSiteJs');
        $this->publishes([__DIR__.'/../database/seeders'=> "database/seeders"],'mhgolijSiteSeeders');
    }
}
