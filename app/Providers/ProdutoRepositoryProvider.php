<?php

namespace App\Providers;

use App\Repositories\EloquentProdutoRepository;
use App\Repositories\ProdutoRepository;
use Illuminate\Support\ServiceProvider;

class ProdutoRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        ProdutoRepository::class => EloquentProdutoRepository::class,
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
