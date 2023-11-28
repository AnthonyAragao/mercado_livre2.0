<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Compra;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

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
        Gate::define('opinarProduct', function(User $user, Compra $compra){
            return $compra->usuario_id === Auth::user()->usuario->first()->id;
        });

        Schema::defaultStringLength(191);
    }
}
