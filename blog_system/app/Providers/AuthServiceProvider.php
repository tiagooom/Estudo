<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Comentario;
use App\Policies\ComentarioPolicy;
use App\Models\Artigo;
use App\Policies\ArtigoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    

protected $policies = [
    Comentario::class => ComentarioPolicy::class,
    Artigo::class => ArtigoPolicy::class,
];


    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
