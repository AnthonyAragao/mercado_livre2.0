<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\DadoAcesso;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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

        Gate::define('isProducer', function (DadoAcesso $user) {
            return !empty($user->produtor->first()) ;
        });



        Schema::defaultStringLength(191);
    }
}
