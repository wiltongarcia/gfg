<?php

namespace App\Providers;

use App\Services\Auth;
use App\Services\Auth\Parser;
use App\Services\Auth\Signer;
use App\Services\Auth\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Auth', function ($app) {
            return new Auth(
                new Parser(), 
                new Validator(), 
                new Signer(),
                config('jwt.secret')
            );
        });
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
