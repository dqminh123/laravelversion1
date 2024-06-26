<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public $bindings = [
        //user
        'App\Services\Interfaces\UserServiceInterface'=>'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface'=>'App\Repositories\UserRepository',
        //usercatalogues
        'App\Services\Interfaces\UserCatalogueServiceInterface'=>'App\Services\UserCatalogueService',
        'App\Repositories\Interfaces\UserCatalogueRepositoryInterface'=>'App\Repositories\UserCatalogueRepository',
        //permission
        'App\Services\Interfaces\PermissionServiceInterface'=>'App\Services\PermissionService',
        'App\Repositories\Interfaces\PermissionRepositoryInterface'=>'App\Repositories\PermissionRepository',
        //postcatalogues
        'App\Services\Interfaces\PostCatalogueServiceInterface'=>'App\Services\PostCatalogueService',
        'App\Repositories\Interfaces\PostCatalogueRepositoryInterface'=>'App\Repositories\PostCatalogueRepository',
        //post
        'App\Services\Interfaces\PostServiceInterface'=>'App\Services\PostService',
        'App\Repositories\Interfaces\PostRepositoryInterface'=>'App\Repositories\PostRepository',
        //language
        'App\Services\Interfaces\LanguageServiceInterface'=>'App\Services\LanguageService',
        'App\Repositories\Interfaces\LanguageRepositoryInterface'=>'App\Repositories\LanguageRepository',
        //router
        'App\Services\Interfaces\RouterServiceInterface'=>'App\Services\RouterService',
        'App\Repositories\Interfaces\RouterRepositoryInterface'=>'App\Repositories\RouterRepository',
        //base
        'App\Services\Interfaces\BaseServiceInterface'=>'App\Services\BaseService',
        'App\Repositories\Interfaces\BaseRepositoryInterface'=>'App\Repositories\BaseRepository',
        //location
        'App\Repositories\Interfaces\ProvinceRepositoryInterface'=>'App\Repositories\ProvinceRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface'=>'App\Repositories\DistrictRepository',
        'App\Repositories\Interfaces\WardRepositoryInterface'=>'App\Repositories\WardRepository',
    ];

    public function register(): void
    {
        foreach($this->bindings as $key => $val)
        {
            $this->app->bind($key,$val);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
