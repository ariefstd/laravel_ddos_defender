<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('Manage Banners', function ($user) {
            return $user->hasAnyPermission([
                'Banner Show',
                'Banner Create',
                'Banner Update',
                'Banner Delete'
            ]);
        });

        Gate::define('Manage Cities', function ($user) {
            return $user->hasAnyPermission([
                'City Show',
                'City Create',
                'City Update',
                'City Delete'
            ]);
        });

        Gate::define('Manage Regions', function ($user) {
            return $user->hasAnyPermission([
                'Region Show',
                'Region Create',
                'Region Update',
                'Region Delete'
            ]);
        });

        Gate::define('Manage Posts', function ($user) {
            return $user->hasAnyPermission([
                'Post Show',
                'Post Create',
                'Post Update',
                'Post Delete'
            ]);
        });

        Gate::define('Manage Post Categories', function ($user) {
            return $user->hasAnyPermission([
                'Post Category Show',
                'Post Category Create',
                'Post Category Update',
                'Post Category Delete'
            ]);
        });

        Gate::define('Manage Tags', function ($user) {
            return $user->hasAnyPermission([
                'Tag Show',
                'Tag Create',
                'Tag Update',
                'Tag Delete'
            ]);
        });

        Gate::define('Manage Galleries', function ($user) {
            return $user->hasAnyPermission([
                'Gallery Show',
                'Gallery Create',
                'Gallery Update',
                'Gallery Delete'
            ]);
        });

        Gate::define('Manage Gallery Categories', function ($user) {
            return $user->hasAnyPermission([
                'Gallery Category Show',
                'Gallery Category Create',
                'Gallery Category Update',
                'Gallery Category Delete'
            ]);
        });

        Gate::define('Manage Partners', function ($user) {
            return $user->hasAnyPermission([
                'Partner Show',
                'Partner Create',
                'Partner Update',
                'Partner Delete'
            ]);
        });

        Gate::define('Manage Markets', function ($user) {
            return $user->hasAnyPermission([
                'Market Show',
                'Market Create',
                'Market Update',
                'Market Delete'
            ]);
        });

        Gate::define('Manage Stalls', function ($user) {
            return $user->hasAnyPermission([
                'Stall Show',
                'Stall Create',
                'Stall Update',
                'Stall Delete'
            ]);
        });

        Gate::define('Manage Stall Categories', function ($user) {
            return $user->hasAnyPermission([
                'Stall Category Show',
                'Stall Category Create',
                'Stall Category Update',
                'Stall Category Delete'
            ]);
        });

        Gate::define('Manage Promos', function ($user) {
            return $user->hasAnyPermission([
                'Promo Show',
                'Promo Create',
                'Promo Update',
                'Promo Delete'
            ]);
        });

        Gate::define('Manage Metas', function ($user) {
            return $user->hasAnyPermission([
                'Meta Show',
                'Meta Create',
                'Meta Update',
                'Meta Delete'
            ]);
        });

        Gate::define('Manage Flash News', function ($user) {
            return $user->hasAnyPermission([
                'Flash New Show',
                'Flash New Create',
                'Flash New Update',
                'Flash New Delete'
            ]);
        });

        Gate::define('Manage Profiles', function ($user) {
            return $user->hasAnyPermission([
                'Profile Show',
                'Profile Create',
                'Profile Update',
                'Profile Delete'
            ]);
        });

        Gate::define('Manage Passwords', function ($user) {
            return $user->hasAnyPermission([
                'Password Show',
                'Password Create',
                'Password Update',
                'Password Delete'
            ]);
        });

        Gate::define('Manage Users', function ($user) {
            return $user->hasAnyPermission([
                'User Show',
                'User Create',
                'User Update',
                'User Delete'
            ]);
        });

        Gate::define('Manage Teams', function ($user) {
            return $user->hasAnyPermission([
                'Team Show',
                'Team Create',
                'Team Update',
                'Team Delete'
            ]);
        });

        Gate::define('Manage Category Team', function ($user) {
            return $user->hasAnyPermission([
                'Category Team Show',
                'Category Team Create',
                'Category Team Update',
                'Category Team Delete'
            ]);
        });

        Gate::define('Manage Banner Promos', function ($user) {
            return $user->hasAnyPermission([
                'Banner Promo Show',
                'Banner Promo Create',
                'Banner Promo Update',
                'Banner Promo Delete'
            ]);
        });

        Gate::define('Manage Catalogs', function ($user) {
            return $user->hasAnyPermission([
                'Catalog Show',
                'Catalog Create',
                'Catalog Update',
                'Catalog Delete'
            ]);
        });

        Gate::define('Manage Rentals', function ($user) {
            return $user->hasAnyPermission([
                'Rental Show',
                'Rental Create',
                'Rental Update',
                'Rental Delete'
            ]);
        });
    }
}
