<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('pendaftaran', function (User $user) {
            return $user->level_id == 1 || $user->level_id == 2;
        });
        Gate::define('perawat', function (User $user) {
            return $user->level_id == 1 || $user->level_id == 3;
        });
        Gate::define('dokter', function (User $user) {
            return $user->level_id == 1 || $user->level_id == 4;
        });
        Gate::define('apoteker', function (User $user) {
            return $user->level_id == 1 || $user->level_id == 5;
        });
        Gate::define('noregistrasi', function (User $user) {
            return $user->level_id != 1 && $user->level_id != 2;
        });
    }
}
