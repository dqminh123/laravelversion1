<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('modules', function($user, $permissionName){ // $user là tài khoản đăng nhập vào hệ thống
            if($user->publish == 0) return false; // ko publish ko truy cập dc
            $permission = $user->user_catalogues->permissions; //condition
            if($permission->contains('canonical',$permissionName)){
                return true;
            }
            return false;
        });
    }
}
